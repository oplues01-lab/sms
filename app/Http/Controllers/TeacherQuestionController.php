<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Term;
use App\Models\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TeacherQuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with(['subject', 'class', 'term', 'academicSession'])
            ->where('teacher_id', Auth::id());

        // Apply filters
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('term_id')) {
            $query->where('term_id', $request->term_id);
        }

        if ($request->filled('academic_session_id')) {
            $query->where('academic_session_id', $request->academic_session_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $questions = $query->latest()->paginate(20)->withQueryString();

        // Get filter options
        $classes = Classes::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $terms = Term::orderBy('name')->get();
        $academic_sessions = AcademicSession::orderBy('name', 'desc')->get();

        return view('teacher.questions.index', compact(
            'questions',
            'classes',
            'subjects',
            'terms',
            'academic_sessions'
        ));
    }

    public function create()
    {
        return view('teacher.questions.create', [
            'subjects' => Subject::orderBy('name')->get(),
            'classes' => Classes::orderBy('name')->get(),
            'terms' => Term::orderBy('name')->get(),
            'academic_sessions' => AcademicSession::orderBy('name', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'term_id' => 'required|exists:terms,id',
            'academic_session_id' => 'required|exists:academic_sessions,id',
            'type' => 'required|in:assessment,exam',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string|max:5000',
            'questions.*.option_a' => 'nullable|string|max:500',
            'questions.*.option_b' => 'nullable|string|max:500',
            'questions.*.option_c' => 'nullable|string|max:500',
            'questions.*.option_d' => 'nullable|string|max:500',
            'questions.*.correct_option' => 'nullable|in:A,B,C,D',
            'questions.*.marks' => 'required|integer|min:1|max:100',
        ]);

        DB::beginTransaction();
        try {
            $questionsData = [];
            foreach ($validated['questions'] as $questionData) {
                $questionsData[] = [
                    'subject_id' => $validated['subject_id'],
                    'class_id' => $validated['class_id'],
                    'term_id' => $validated['term_id'],
                    'academic_session_id' => $validated['academic_session_id'],
                    'type' => $validated['type'],
                    'question' => $questionData['question'],
                    'option_a' => $questionData['option_a'] ?? null,
                    'option_b' => $questionData['option_b'] ?? null,
                    'option_c' => $questionData['option_c'] ?? null,
                    'option_d' => $questionData['option_d'] ?? null,
                    'correct_option' => $questionData['correct_option'] ?? null,
                    'marks' => $questionData['marks'],
                    'teacher_id' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Question::insert($questionsData);
            DB::commit();

            return redirect()
                ->route('teacher.questions.index')
                ->with('success', count($questionsData) . ' questions added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to save questions. Please try again.']);
        }
    }

    public function edit(Question $question)
    {
        if ($question->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.questions.edit', [
            'question' => $question,
            'subjects' => Subject::orderBy('name')->get(),
            'classes' => Classes::orderBy('name')->get(),
            'terms' => Term::orderBy('name')->get(),
            'academic_sessions' => AcademicSession::orderBy('name', 'desc')->get(),
        ]);
    }

    public function update(Request $request, Question $question)
    {
        if ($question->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'type' => 'required|in:assessment,exam',
            'question' => 'required|string|max:5000',
            'option_a' => 'nullable|string|max:500',
            'option_b' => 'nullable|string|max:500',
            'option_c' => 'nullable|string|max:500',
            'option_d' => 'nullable|string|max:500',
            'correct_option' => 'nullable|in:A,B,C,D',
            'marks' => 'required|integer|min:1|max:100',
        ]);

        $question->update($validated);

        return redirect()
            ->route('teacher.questions.index')
            ->with('success', 'Question updated successfully');
    }

    public function exportPdf(Request $request)
    {
        $query = Question::with(['subject', 'class', 'term', 'academicSession'])
            ->where('teacher_id', Auth::id());

        // Apply same filters as index
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('term_id')) {
            $query->where('term_id', $request->term_id);
        }

        if ($request->filled('academic_session_id')) {
            $query->where('academic_session_id', $request->academic_session_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $questions = $query->get();

        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'No questions to export');
        }

        // Get metadata from first question
        $metadata = [
            'class' => $questions->first()->class->name,
            'subject' => $questions->first()->subject->name,
            'term' => $questions->first()->term->name,
            'session' => $questions->first()->academicSession->name,
            'type' => ucfirst($questions->first()->type),
        ];

        $pdf = Pdf::loadView('teacher.questions.pdf', compact('questions', 'metadata'));
        
        $filename = 'questions_' . $metadata['class'] . '_' . $metadata['subject'] . '_' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function exportCsv(Request $request)
    {
        $query = Question::with(['subject', 'class', 'term', 'academicSession'])
            ->where('teacher_id', Auth::id());

        // Apply same filters as index
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('term_id')) {
            $query->where('term_id', $request->term_id);
        }

        if ($request->filled('academic_session_id')) {
            $query->where('academic_session_id', $request->academic_session_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $questions = $query->get();

        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'No questions to export');
        }

        // Get metadata from first question
        $metadata = [
            'class' => $questions->first()->class->name,
            'subject' => $questions->first()->subject->name,
            'term' => $questions->first()->term->name,
            'session' => $questions->first()->academicSession->name,
            'type' => ucfirst($questions->first()->type),
        ];

        $filename = 'questions_' . str_replace(' ', '_', $metadata['class']) . '_' . 
                    str_replace(' ', '_', $metadata['subject']) . '_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($questions, $metadata) {
            $file = fopen('php://output', 'w');
            
            // Add metadata as header
            fputcsv($file, ['Class:', $metadata['class']]);
            fputcsv($file, ['Subject:', $metadata['subject']]);
            fputcsv($file, ['Term:', $metadata['term']]);
            fputcsv($file, ['Session:', $metadata['session']]);
            fputcsv($file, ['Type:', $metadata['type']]);
            fputcsv($file, []); // Empty row
            
            // Column headers
            fputcsv($file, [
                '#', 
                'Question', 
                'Option A', 
                'Option B', 
                'Option C', 
                'Option D', 
                'Correct Answer', 
                'Marks'
            ]);

            foreach ($questions as $index => $q) {
                fputcsv($file, [
                    $index + 1,
                    $q->question,
                    $q->option_a,
                    $q->option_b,
                    $q->option_c,
                    $q->option_d,
                    $q->correct_option,
                    $q->marks
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}