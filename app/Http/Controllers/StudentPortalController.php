<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Student;
use App\Models\StudentResult;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentPortalController extends Controller
{
    public function dashboard()
    {
        $student = $this->getAuthenticatedStudent();
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found');
        }

        // Get assignments for student's class
        $assignments = Assignment::where('class_id', $student->class_id)
            ->where('status', 'published')
            ->when($student->class_arm_id, function($query) use ($student) {
                return $query->where(function($q) use ($student) {
                    $q->whereNull('class_arm_id')
                      ->orWhere('class_arm_id', $student->class_arm_id);
                });
            })
            ->with(['subject', 'teacher'])
            ->latest()
            ->take(5)
            ->get();

        // Get recent submissions
        $recentSubmissions = AssignmentSubmission::where('student_id', $student->id)
            ->with(['assignment.subject'])
            ->latest()
            ->take(5)
            ->get();

        // Get statistics
        $stats = [
            'pending_assignments' => Assignment::where('class_id', $student->class_id)
                ->where('status', 'published')
                ->whereDoesntHave('submissions', function($q) use ($student) {
                    $q->where('student_id', $student->id);
                })
                ->count(),
            'submitted_assignments' => AssignmentSubmission::where('student_id', $student->id)
                ->whereIn('status', ['submitted', 'graded'])
                ->count(),
            'graded_assignments' => AssignmentSubmission::where('student_id', $student->id)
                ->where('status', 'graded')
                ->count(),
            'average_score' => AssignmentSubmission::where('student_id', $student->id)
                ->where('status', 'graded')
                ->whereNotNull('marks_obtained')
                ->avg('marks_obtained') ?? 0,
        ];

        return view('students.portal.dashboard', compact('student', 'assignments', 'recentSubmissions', 'stats'));
    }

    public function assignments(Request $request)
    {
        $student = $this->getAuthenticatedStudent();
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found');
        }

        $query = Assignment::where('class_id', $student->class_id)
            ->where('status', 'published')
            ->when($student->class_arm_id, function($query) use ($student) {
                return $query->where(function($q) use ($student) {
                    $q->whereNull('class_arm_id')
                      ->orWhere('class_arm_id', $student->class_arm_id);
                });
            })
            ->with(['subject', 'teacher']);

        // Filter by status
        if ($request->filled('filter')) {
            if ($request->filter === 'pending') {
                $query->whereDoesntHave('submissions', function($q) use ($student) {
                    $q->where('student_id', $student->id);
                });
            } elseif ($request->filter === 'submitted') {
                $query->whereHas('submissions', function($q) use ($student) {
                    $q->where('student_id', $student->id)
                      ->where('status', 'submitted');
                });
            } elseif ($request->filter === 'graded') {
                $query->whereHas('submissions', function($q) use ($student) {
                    $q->where('student_id', $student->id)
                      ->where('status', 'graded');
                });
            }
        }

        $assignments = $query->latest()->paginate(15)->withQueryString();

        // Get submission status for each assignment
        $assignmentIds = $assignments->pluck('id')->toArray();
        $submissions = AssignmentSubmission::where('student_id', $student->id)
            ->whereIn('assignment_id', $assignmentIds)
            ->get()
            ->keyBy('assignment_id');

        return view('students.assignments.index', compact('student', 'assignments', 'submissions'));
    }

    public function showAssignment(Assignment $assignment)
    {
        $student = $this->getAuthenticatedStudent();
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found');
        }

        // Check if assignment is for student's class
        if ($assignment->class_id !== $student->class_id) {
            abort(403, 'This assignment is not for your class');
        }

        $assignment->load(['subject', 'teacher', 'class', 'classArm']);

        // Get student's submission if exists
        $submission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->first();

        return view('students.assignments.show', compact('assignment', 'submission', 'student'));
    }

    public function submitAssignment(Request $request, Assignment $assignment)
    {
        $student = $this->getAuthenticatedStudent();
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found');
        }

        // Check if assignment is for student's class
        if ($assignment->class_id !== $student->class_id) {
            abort(403, 'This assignment is not for your class');
        }

        // Check if already submitted
        $existingSubmission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existingSubmission && $existingSubmission->status !== 'pending') {
            return redirect()->back()->with('error', 'You have already submitted this assignment');
        }

        $validated = $request->validate([
            'submission_text' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // At least one field must be filled
        if (empty($validated['submission_text']) && !$request->hasFile('attachment')) {
            return redirect()->back()->with('error', 'Please provide either text submission or attachment');
        }

        $data = [
            'assignment_id' => $assignment->id,
            'student_id' => $student->id,
            'submission_text' => $validated['submission_text'] ?? null,
            'status' => 'submitted',
            'submitted_at' => now(),
        ];

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $student->id . '_' . $file->getClientOriginalName();
            $file->storeAs('submissions', $filename, 'public');
            $data['attachment'] = $filename;
        }

        if ($existingSubmission) {
            // Delete old file if exists
            if ($existingSubmission->attachment && $request->hasFile('attachment')) {
                Storage::disk('public')->delete('submissions/' . $existingSubmission->attachment);
            }
            $existingSubmission->update($data);
        } else {
            AssignmentSubmission::create($data);
        }

        return redirect()
            ->route('students.assignments.show', $assignment)
            ->with('success', 'Assignment submitted successfully');
    }

    public function results()
    {
        $student = $this->getAuthenticatedStudent();
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found');
        }

        // Get graded assignments
        $gradedSubmissions = AssignmentSubmission::with(['assignment.subject'])
            ->where('student_id', $student->id)
            ->where('status', 'graded')
            ->latest('graded_at')
            ->paginate(20);

        return view('students.assignments.results', compact('student', 'gradedSubmissions'));
    }

    public function profile()
    {
        $student = $this->getAuthenticatedStudent();
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found');
        }

        $student->load(['classes', 'class_arm', 'term', 'academicsessions']);

        return view('students.portal.profile', compact('student'));
    }

   private function getAuthenticatedStudent()
{
    $user = Auth::user();
    
    if (!$user) {
        return null;
    }

    // Fetch student by user_id instead of email
    return Student::where('user_id', $user->id)->first();
}

}