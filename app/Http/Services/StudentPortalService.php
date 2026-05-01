<?php

namespace App\Http\Services;

use App\Models\Student;
use App\Models\Assignment;
use App\Models\Announcement;
use App\Models\CertificateRequest;
use Illuminate\Support\Collection;

class StudentPortalService
{
    /**
     * Get student dashboard data
     */
    public function getDashboardData(Student $student): array
    {
        return [
            'upcoming_assignments' => $this->getUpcomingAssignments($student),
            'recent_results' => $this->getRecentResults($student),
            'attendance_summary' => $this->getAttendanceSummary($student),
            'announcements' => $this->getRecentAnnouncements($student),
            'pending_fees' => $this->getPendingFees($student),
        ];
    }

    /**
     * Get assignments for student
     */
    public function getAssignmentsForStudent(Student $student, ?string $status = null): Collection
    {
        $query = Assignment::published()
            ->forClass($student->class_id, $student->class_arm_id)
            ->where('term_id', $student->term_id)
            ->where('academic_sessions_id', $student->academic_sessions_id)
            ->with(['subject', 'teacher']);
        
        if ($status === 'upcoming') {
            $query->upcoming();
        } elseif ($status === 'overdue') {
            $query->overdue();
        }
        
        return $query->orderBy('due_date', 'asc')->get();
    }

    /**
     * Submit assignment
     */
    public function submitAssignment(Student $student, Assignment $assignment, array $data): \App\Models\AssignmentSubmission
    {
        // Check if already submitted
        if ($assignment->hasSubmission($student)) {
            throw new \Exception('Assignment already submitted');
        }

        return $assignment->submissions()->create([
            'student_id' => $student->id,
            'content' => $data['content'] ?? null,
            'file_path' => $data['file_path'] ?? null,
            'files' => $data['files'] ?? null,
        ]);
    }

    /**
     * Request certificate
     */
    public function requestCertificate(Student $student, array $data): CertificateRequest
    {
        return CertificateRequest::create([
            'student_id' => $student->id,
            'certificate_type' => $data['certificate_type'],
            'purpose' => $data['purpose'],
            'additional_info' => $data['additional_info'] ?? null,
            'copies_requested' => $data['copies_requested'] ?? 1,
        ]);
    }

    /**
     * Get student results
     */
    public function getResults(Student $student, ?int $termId = null)
    {
        // This will integrate with existing results system
        // Return student results with conduct grades
        return [];
    }

    /**
     * Private helper methods
     */
    private function getUpcomingAssignments(Student $student, int $limit = 5): Collection
    {
        return $this->getAssignmentsForStudent($student, 'upcoming')
            ->take($limit);
    }

    private function getRecentResults(Student $student, int $limit = 3)
    {
        // Get most recent term results
        return [];
    }

    private function getAttendanceSummary(Student $student): array
    {
        // Calculate attendance percentage
        return [
            'present' => 0,
            'absent' => 0,
            'percentage' => 0,
        ];
    }

    private function getRecentAnnouncements(Student $student, int $limit = 5): Collection
    {
        return Announcement::active()
            ->forAudience('students')
            ->orderBy('publish_date', 'desc')
            ->limit($limit)
            ->get();
    }

    private function getPendingFees(Student $student)
    {
        // Get pending fee information
        return [];
    }
}