<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisciplinaryAction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'action_number',
        'student_id',
        'conduct_record_id',
        'incident_report_id',
        'issued_by',
        'approved_by',
        'term_id',
        'academic_sessions_id',
        'action_type',
        'reason',
        'details',
        'action_date',
        'start_date',
        'end_date',
        'duration_days',
        'conditions',
        'parent_notified',
        'parent_notified_at',
        'parent_acknowledgment',
        'affects_academics',
        'affects_extracurricular',
        'academic_plan',
        'status',
        'appeal_notes',
        'completed_at',
        'completion_notes',
        'record_sealed',
        'seal_date',
    ];

    protected $casts = [
        'action_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'parent_notified' => 'boolean',
        'parent_notified_at' => 'datetime',
        'affects_academics' => 'boolean',
        'affects_extracurricular' => 'boolean',
        'completed_at' => 'datetime',
        'record_sealed' => 'boolean',
        'seal_date' => 'date',
        'duration_days' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->action_number)) {
                $model->action_number = self::generateActionNumber();
            }
            
            // Auto-calculate duration if dates are set
            if ($model->start_date && $model->end_date) {
                $model->duration_days = $model->start_date->diffInDays($model->end_date) + 1;
            }
        });
    }

    // Relationships
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function conductRecord(): BelongsTo
    {
        return $this->belongsTo(ConductRecord::class);
    }

    public function incidentReport(): BelongsTo
    {
        return $this->belongsTo(IncidentReport::class);
    }

    public function issuedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'academic_sessions_id');
    }

    public function counselingSessions(): HasMany
    {
        return $this->hasMany(CounselingSession::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where(function($q) {
                         $q->whereNull('end_date')
                           ->orWhere('end_date', '>=', now());
                     });
    }

    public function scopeSuspensions($query)
    {
        return $query->where('action_type', 'suspension');
    }

    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    // Methods
    public static function generateActionNumber(): string
    {
        $year = date('Y');
        $lastAction = self::whereYear('created_at', $year)
                          ->orderBy('id', 'desc')
                          ->first();
        
        $nextNumber = $lastAction ? 
            ((int) substr($lastAction->action_number, -3)) + 1 : 1;
        
        return 'DA-' . $year . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    public function isActive(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        if ($this->end_date && $this->end_date < now()) {
            return false;
        }

        return true;
    }

    public function complete(string $notes = null): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
            'completion_notes' => $notes,
        ]);
    }

    public function getActionTypeLabelAttribute(): string
    {
        return str_replace('_', ' ', ucwords($this->action_type, '_'));
    }

    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->end_date || $this->status !== 'active') {
            return null;
        }

        return max(0, now()->diffInDays($this->end_date, false));
    }
}