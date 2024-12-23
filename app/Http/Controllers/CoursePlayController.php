<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursePlayController extends Controller
{
    public function index(Course $course)
    {
        if (Auth::check()){

        $videos=Video::where('course_id',$course->id)->get()->sortBy('created_at');
        return view('courseplay', ["videos"=>$videos]);
        }else {
            return back()->withErrors("You must be logged in to play course");
        }
    }
}
