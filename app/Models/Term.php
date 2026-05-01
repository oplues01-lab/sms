<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    /** @use HasFactory<\Database\Factories\TermFactory> */
    use HasFactory;
    protected $fillable = ['name', 'code','status'];
     public function student(){
        return $this->hasMany(Student::class, 'term_id');
    }
}
