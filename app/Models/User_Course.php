<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Course extends Model
{
    protected $table = 'user_courses';
    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
