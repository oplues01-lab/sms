<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicSession extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicSessionFactory> */
    use HasFactory;
      protected $table = "academic_sessions";
    
    protected $fillable = ['name', 'code', 'status'];
     public function student(){
        return $this->hasMany(Student::class, 'academic_sessions_id');
    }
}
