<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Class_arm;
use App\Models\Term;
use App\Models\AcademicSession;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Assignment::with(['class', 'classArm', 'subject', 'term', 'academicSession'])
            ->where('teacher_id', Auth::id());

        // Apply filters
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $assignments = $query->latest()->paginate(15)->withQueryString();

        // Get filter options
        $classes = Classes::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();

        return view('teacher.assignments.index', compact('assignments', 'classes', 'subjects'));
    }

    public function create()
    {
        return view('teacher.assignments.create', [
            'subjects' => Subject::orderBy('name')->get(),
            'classes' => Classes::orderBy('name')->get(),
            'classArms' => Class_arm::orderBy('name')->get(),
            'terms' => Term::orderBy('name')->get(),
            'academic_sessions' => AcademicSession::orderBy('name', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'class_arm_id' => 'nullable|exists:class_arms,id',
            'subject_id' => 'required|exists:subjects,id',
            'term_id' => 'required|exists:terms,id',
            'academic_session_id' => 'required|exists:academic_sessions,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'total_marks' => 'required|integer|min:1|max:100',
            'due_date' => 'required|date|after:now',
            'status' => 'required|in:draft,published',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,csv,xlsx|max:10240',
        ]);

        $validated['teacher_id'] = Auth::id();

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('assignments', $filename, 'public');
            $validated['attachment'] = $filename;
        }

        $assignment = Assignment::create($validated);

        return redirect()
            ->route('teacher.assignments.show', $assignment)
            ->with('success', 'Assignment created successfully');
    }

    public function show(Assignment $assignment)
    {
        // Check authorization
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $assignment->load(['class', 'classArm', 'subject', 'term', 'academicSession']);
        
        $submissions = AssignmentSubmission::with('student')
            ->where('assignment_id', $assignment->id)
            ->latest()
            ->get();

        $stats = [
            'total_students' => $assignment->getStudentsCount(),
            'submitted' => $assignment->getSubmissionsCount(),
            'graded' => $assignment->getGradedCount(),
            'pending' => $assignment->getStudentsCount() - $assignment->getSubmissionsCount(),
        ];

        return view('teacher.assignments.show', compact('assignment', 'submissions', 'stats'));
    }

    public function edit(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.assignments.edit', [
            'assignment' => $assignment,
            'subjects' => Subject::orderBy('name')->get(),
            'classes' => Classes::orderBy('name')->get(),
            'classArms' => Class_arm::orderBy('name')->get(),
            'terms' => Term::orderBy('name')->get(),
            'academic_sessions' => AcademicSession::orderBy('name', 'desc')->get(),
        ]);
    }

    public function update(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'class_arm_id' => 'nullable|exists:class_arms,id',
            'subject_id' => 'required|exists:subjects,id',
            'term_id' => 'required|exists:terms,id',
            'academic_session_id' => 'required|exists:academic_sessions,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'total_marks' => 'required|integer|min:1|max:100',
            'due_date' => 'required|date',
            'status' => 'required|in:draft,published',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,csv,xlsx|max:10240',
        ]);

        // Handle file upload
        if ($request->hasFile('attachment')) {
            // Delete old file
            if ($assignment->attachment) {
                Storage::disk('public')->delete('assignments/' . $assignment->attachment);
            }
            
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('assignments', $filename, 'public');
            $validated['attachment'] = $filename;
        }

        $assignment->update($validated);

        return redirect()
            ->route('teacher.assignments.show', $assignment)
            ->with('success', 'Assignment updated successfully');
    }

    public function gradeSubmission(Request $request, AssignmentSubmission $submission)
    {
        $assignment = $submission->assignment;
        
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'marks_obtained' => 'required|integer|min:0|max:' . $assignment->total_marks,
            'teacher_feedback' => 'nullable|string',
        ]);

        $validated['status'] = 'graded';
        $validated['graded_at'] = now();

        $submission->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Submission graded successfully');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete attachment
        if ($assignment->attachment) {
            Storage::disk('public')->delete('assignments/' . $assignment->attachment);
        }

        $assignment->delete();

        return redirect()
            ->route('teacher.assignments.index')
            ->with('success', 'Assignment deleted successfully');
    }
}