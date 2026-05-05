<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Class_arm extends Model
{
    /** @use HasFactory<\Database\Factories\ClassArmFactory> */
    use HasFactory;
    protected $table = "class_arms";
    
    protected $fillable = ['name', 'code', 'status'];
 public function student(){
        return $this->hasMany(Student::class, 'class_arm_id');
    }
}
