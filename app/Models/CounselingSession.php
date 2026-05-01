<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CounselingSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'session_number',
        'student_id',
        'counselor_id',
        'disciplinary_action_id',
        'term_id',
        'academic_sessions_id',
        'session_type',
        'referral_source',
        'referral_reason',
        'session_datetime',
        'duration_minutes',
        'location',
        'concerns_addressed',
        'discussion_notes',
        'goals_set',
        'action_plan',
        'recommendations',
        'parent_involvement',
        'parent_notes',
        'follow_up_required',
        'follow_up_date',
        'student_attitude',
        'progress_level',
        'confidential',
        'status',
        'cancellation_reason',
    ];

    protected $casts = [
        'session_datetime' => 'datetime',
        'follow_up_date' => 'date',
        'parent_involvement' => 'boolean',
        'follow_up_required' => 'boolean',
        'confidential' => 'boolean',
        'duration_minutes' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->session_number)) {
                $model->session_number = self::generateSessionNumber();
            }
        });
    }

    // Relationships
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function counselor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }

    public function disciplinaryAction(): BelongsTo
    {
        return $this->belongsTo(DisciplinaryAction::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'academic_sessions_id');
    }

    // Scopes
    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
                     ->where('session_datetime', '>', now());
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeRequiresFollowUp($query)
    {
        return $query->where('follow_up_required', true)
                     ->whereNotNull('follow_up_date');
    }

    public function scopeNonConfidential($query)
    {
        return $query->where('confidential', false);
    }

    // Methods
    public static function generateSessionNumber(): string
    {
        $year = date('Y');
        $lastSession = self::whereYear('created_at', $year)
                           ->orderBy('id', 'desc')
                           ->first();
        
        $nextNumber = $lastSession ? 
            ((int) substr($lastSession->session_number, -3)) + 1 : 1;
        
        return 'CS-' . $year . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    public function markAsCompleted(): void
    {
        $this->update(['status' => 'completed']);
    }

    public function cancel(string $reason): void
    {
        $this->update([
            'status' => 'cancelled',
            'cancellation_reason' => $reason,
        ]);
    }

    public function getSessionTypeLabelAttribute(): string
    {
        return str_replace('_', ' ', ucwords($this->session_type, '_'));
    }

    public function getProgressColorAttribute(): string
    {
        return match($this->progress_level) {
            'excellent' => 'green',
            'good' => 'blue',
            'fair' => 'yellow',
            'poor' => 'orange',
            'no_change' => 'red',
            default => 'gray',
        };
    }
}