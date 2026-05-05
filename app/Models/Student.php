<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'rpin',
        'phone',
        'admission_no',
        'class_id',
        'class_arm_id',
        'term_id',
        'academic_sessions_id',
        'status',
        'photo',
        'parent_name',
        'parent_phone',
        'user_id',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    /**
     * Relationships
     */
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function class_arm()
    {
        return $this->belongsTo(Class_arm::class, 'class_arm_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function academicsessions()
    {
        return $this->belongsTo(AcademicSession::class, 'academic_sessions_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessors
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return \Storage::url('students/' . $this->photo);
        }
        return null;
    }

    /**
     * Helper methods
     */
    public function hasPhoto()
    {
        return !empty($this->photo);
    }

    public function comments()
{
    return $this->hasMany(StudentComment::class);
}
}