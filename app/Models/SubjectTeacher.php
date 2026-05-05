<?php

namespace App\Models;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectTeacher extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectTeacherFactory> */
    use HasFactory;
    protected $table = 'subject_teachers';
    protected $fillable = ['subject_id', 'teacher_id', 'class_id', 'classarm_id'];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');

    }   
    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
        
    }
    
    public function classes(){
        return $this->belongsTo(Classes::class, 'class_id');
        
    }
    
    public function classarm(){
        return $this->belongsTo(Class_arm::class, 'classarm_id');
        
    }
}
