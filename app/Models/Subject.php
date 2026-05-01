<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;
    protected $fillable = ['name', 'code','status'];

    public function staff(){
        return $this->belongsToMany(User::class, 'subject_teachers', 'subject_id', 'teacher_id')->withPivote('class_id','classarm_id')->withTimeStamps();
        
    }

    
}
