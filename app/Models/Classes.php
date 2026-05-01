<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    /** @use HasFactory<\Database\Factories\ClassesFactory> */
    use HasFactory;
    protected $table = "classes";
    
    protected $fillable = ['name', 'code', 'status'];

    public function student(){
        return $this->hasMany(Student::class, 'class_id');
    }
  
}
