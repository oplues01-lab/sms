<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    /** @use HasFactory<\Database\Factories\StaffFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'designation', 'phone', 'status', 'photo'];

    public function user(){
        return $this->belongsTo(User::class); 
    }

    public function subject(){
        return $this->belongsToMany(Subject::class);
    }

}
