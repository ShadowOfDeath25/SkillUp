<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class CoursePlayController extends Controller
{
    public function index(Course $course)
    {
        $videos=Video::where('course_id',$course->id)->get()->sortBy('created_at');
        return view('courseplay', ["videos"=>$videos]);
    }
}
