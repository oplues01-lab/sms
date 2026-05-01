<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_id',
        'class_arm_id',
        'subject_id',
        'term_id',
        'academic_session_id',
        'title',
        'description',
        'attachment',
        'total_marks',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function classArm()
    {
        return $this->belongsTo(Class_arm::class, 'class_arm_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function isOverdue()
    {
        return $this->due_date->isPast();
    }

    public function getStudentsCount()
    {
        $query = Student::where('class_id', $this->class_id);
        
        if ($this->class_arm_id) {
            $query->where('class_arm_id', $this->class_arm_id);
        }
        
        return $query->count();
    }

    public function getSubmissionsCount()
    {
        return $this->submissions()->where('status', 'submitted')->orWhere('status', 'graded')->count();
    }

    public function getGradedCount()
    {
        return $this->submissions()->where('status', 'graded')->count();
    }
}