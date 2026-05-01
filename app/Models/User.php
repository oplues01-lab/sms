<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Staff;

use App\Models\Classes;


use App\Models\Subject;
use App\Models\Class_arm;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class, 'subject_teachers', 'teacher_id', 'subject_id')->withPivot('class_id','classarm_id')->withTimestamps();
    }
    public function classes(){
        return $this->belongsToMany(Classes::class, 'subject_teachers','teacher_id', 'class_id')->withPivot('classarm_id', 'subject_id')->withTimestamps();

    }

     public function classarms(){
        return $this->belongsToMany(Class_arm::class, 'subject_teachers','teacher_id', 'classarm_id')->withPivot('class_id', 'subject_id')->withTimestamps();
        
    }

    public function staff(){
        return $this->hasOne(Staff::class);
    }





}
