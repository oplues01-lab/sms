<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'submission_text',
        'attachment',
        'marks_obtained',
        'teacher_feedback',
        'status',
        'submitted_at',
        'graded_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function isLate()
    {
        if (!$this->submitted_at) {
            return false;
        }
        
        return $this->submitted_at->isAfter($this->assignment->due_date);
    }

    public function getPercentage()
    {
        if (!$this->marks_obtained || !$this->assignment->total_marks) {
            return 0;
        }
        
        return round(($this->marks_obtained / $this->assignment->total_marks) * 100, 2);
    }

    public function getGrade()
    {
        $percentage = $this->getPercentage();
        
        if ($percentage >= 70) return 'A';
        if ($percentage >= 60) return 'B';
        if ($percentage >= 50) return 'C';
        if ($percentage >= 40) return 'D';
        return 'F';
    }
}