<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Assignment;
use App\Models\Announcement;
use App\Services\StudentPortalService;
use App\Services\BehaviorService;

class DashboardController extends Controller
{
    public function __construct(
        private StudentPortalService $studentService,
        private BehaviorService $behaviorService
    ) {
        $this->middleware('auth');
    }

    /**
     * Display student dashboard
     */
    public function index()
    {
        // Get current student from authenticated user
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        // Get dashboard data
        $dashboardData = $this->studentService->getDashboardData($student);

        // Get behavior summary
        $behaviorSummary = $this->behaviorService->getStudentBehaviorSummary(
            $student,
            $student->term_id,
            $student->academic_sessions_id
        );

        // Get conduct grade for current term
        $conductGrade = $this->behaviorService->calculateConductGrade(
            $student,
            $student->term_id,
            $student->academic_sessions_id
        );

        // Recent assignments
        $recentAssignments = Assignment::published()
            ->forClass($student->class_id, $student->class_arm_id)
            ->where('term_id', $student->term_id)
            ->where('academic_sessions_id', $student->academic_sessions_id)
            ->orderBy('due_date', 'asc')
            ->limit(5)
            ->get();

        // Upcoming assignments (not submitted)
        $upcomingAssignments = $recentAssignments->filter(function($assignment) use ($student) {
            return !$assignment->hasSubmission($student) && !$assignment->isOverdue();
        });

        // Overdue assignments (not submitted)
        $overdueAssignments = $recentAssignments->filter(function($assignment) use ($student) {
            return !$assignment->hasSubmission($student) && $assignment->isOverdue();
        });

        // Recent announcements
        $announcements = Announcement::active()
            ->forAudience('students')
            ->whereJsonContains('target_classes', $student->class_id)
            ->orWhereJsonContains('target_audience', 'all')
            ->orderBy('publish_date', 'desc')
            ->limit(5)
            ->get();

        // Stats
        $stats = [
            'total_assignments' => $recentAssignments->count(),
            'upcoming_assignments' => $upcomingAssignments->count(),
            'overdue_assignments' => $overdueAssignments->count(),
            'unread_announcements' => $announcements->filter(fn($a) => !$a->isReadBy(auth()->user()))->count(),
            'conduct_grade' => $conductGrade['grade'],
            'conduct_score' => $conductGrade['score'],
        ];

        return view('student.dashboard', compact(
            'student',
            'dashboardData',
            'behaviorSummary',
            'conductGrade',
            'upcomingAssignments',
            'overdueAssignments',
            'announcements',
            'stats'
        ));
    }
}