<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Class_arm;
use App\Models\Term;
use App\Models\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentCommentController extends Controller
{
    /**
     * Display the comment management page
     */
    public function index()
    {
        $classes = Classes::all();
        $class_arms = Class_arm::all();
        $terms = Term::all();
        $sessions = AcademicSession::all();

        return view('student_comments.index', compact(
            'classes',
            'class_arms',
            'terms',
            'sessions'
        ));
    }

    /**
     * Get students for selected class/arm/term/session
     */
   public function getStudents(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:classes,id',
        'class_arm_id' => 'required|exists:class_arms,id',
        'term_id' => 'required|exists:terms,id',
        'session_id' => 'required|exists:academic_sessions,id',
        'comment_type' => 'required|in:class_teacher,principal',
    ]);

    // Get students
    $students = Student::where('class_id', $request->class_id)
        ->where('class_arm_id', $request->class_arm_id)
        ->select('id', 'admission_no', 'first_name', 'last_name')
        ->orderBy('first_name')
        ->get();

    // Get existing comments in ONE query
    $comments = Comment::where('term_id', $request->term_id)
        ->where('session_id', $request->session_id)
        ->where('comment_type', $request->comment_type)
        ->get()
        ->keyBy('student_id');

    // Merge data
    $students = $students->map(function ($student) use ($comments) {

        $existingComment = $comments->get($student->id);

        return [
            'id' => $student->id,
            'admission_no' => $student->admission_no,
            'full_name' => $student->first_name . ' ' . $student->last_name,
            'has_comment' => $existingComment ? true : false,
            'comment' => $existingComment->comment ?? null,
            'comment_id' => $existingComment->id ?? null,
        ];
    });

    return response()->json($students);
}


    /**
     * Store or update comment
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'class_arm_id' => 'required|exists:class_arms,id',
            'term_id' => 'required|exists:terms,id',
            'session_id' => 'required|exists:academic_sessions,id',
            'comment_type' => 'required|in:class_teacher,principal',
            'comment' => 'required|string|max:1000',
        ]);

        try {
            // Get student's admission number
            $student = Student::findOrFail($request->student_id);

            $comment = Comment::updateOrCreate(
                [
                    'student_id' => $request->student_id,
                    'term_id' => $request->term_id,
                    'session_id' => $request->session_id,
                    'comment_type' => $request->comment_type,
                ],
                [
                    'admission_no' => $student->admission_no,
                    'class_id' => $request->class_id,
                    'class_arm_id' => $request->class_arm_id,
                    'comment' => $request->comment,
                    'commented_by' => auth()->id(),
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Comment saved successfully',
                'comment_id' => $comment->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving comment: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete comment
     */
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            
            // Optional: Check if user has permission to delete
            // if ($comment->commented_by !== auth()->id() && !auth()->user()->hasRole('admin')) {
            //     return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            // }

            $comment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Comment deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting comment: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get comment for a specific student
     */
    public function getComment(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'term_id' => 'required|exists:terms,id',
            'session_id' => 'required|exists:academic_sessions,id',
            'comment_type' => 'required|in:class_teacher,principal',
        ]);

        $comment = Comment::where([
            'student_id' => $request->student_id,
            'term_id' => $request->term_id,
            'session_id' => $request->session_id,
            'comment_type' => $request->comment_type,
        ])->first();

        if ($comment) {
            return response()->json([
                'success' => true,
                'comment' => $comment->comment,
                'comment_id' => $comment->id,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No comment found',
        ]);
    }
}