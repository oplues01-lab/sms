<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Announcement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'created_by',
        'title',
        'content',
        'priority',
        'target_audience',
        'target_classes',
        'publish_date',
        'expiry_date',
        'is_published',
        'send_email',
        'send_sms',
        'attachment_path',
        'views_count',
    ];

    protected $casts = [
        'target_audience' => 'array',
        'target_classes' => 'array',
        'publish_date' => 'datetime',
        'expiry_date' => 'datetime',
        'is_published' => 'boolean',
        'send_email' => 'boolean',
        'send_sms' => 'boolean',
        'views_count' => 'integer',
    ];

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function readers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'announcement_reads')
                    ->withPivot('read_at')
                    ->withTimestamps();
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where(function($q) {
                         $q->whereNull('publish_date')
                           ->orWhere('publish_date', '<=', now());
                     });
    }

    public function scopeActive($query)
    {
        return $query->published()
                     ->where(function($q) {
                         $q->whereNull('expiry_date')
                           ->orWhere('expiry_date', '>=', now());
                     });
    }

    public function scopeForAudience($query, $role)
    {
        return $query->whereJsonContains('target_audience', $role);
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }

    // Methods
    public function markAsRead(User $user): void
    {
        if (!$this->isReadBy($user)) {
            $this->readers()->attach($user->id, ['read_at' => now()]);
            $this->increment('views_count');
        }
    }

    public function isReadBy(User $user): bool
    {
        return $this->readers()->where('user_id', $user->id)->exists();
    }

    public function isExpired(): bool
    {
        return $this->expiry_date && $this->expiry_date < now();
    }

    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'urgent' => 'red',
            'high' => 'orange',
            'normal' => 'blue',
            default => 'gray',
        };
    }
}