<?php

namespace App\Models;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Subject;
use App\Models\AcademicSession;

use App\Models\Class_arm;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentResult extends Model
{
    /** @use HasFactory<\Database\Factories\StudentResultFactory> */
    use HasFactory;
        protected $fillable = [
        'student_id', 'subject_id', 'class_id', 'class_arm_id', 
        'session_id', 'term_id', 'ca_score', 'exam_score', 'total', 'recorded_by',    'admission_no',

    ];





    

       public function student() {
        return $this->belongsTo(Student::class,'student_id', 'id');
    }

  public function subject()
{
    return $this->belongsTo(Subject::class, 'subject_id', 'id');
}


    public function classes() {
        return $this->belongsTo(Classes::class); // adjust name
    }

    public function classarm() {
        return $this->belongsTo(Class_arm::class);
    }
    public function accademic_session() {
        return $this->belongsTo(AcademicSession::class);
    }
    public function teacher() {
        return $this->belongsTo(User::class, 'recorded_by');
    }

}
