<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User_Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseDetailsController extends Controller
{
    public function index(Course $course)
    {
        $enrolled=False;
        if (Auth::check()) {
            $enrolled_courses = User_Course::where('user_id', Auth::user()->id)
                ->where('course_id', $course->id)
                ->get();
            if ($enrolled_courses->isNotEmpty()) {
                $enrolled=True;
            }
        }


        return view('CourseDetails', ['course' => $course,'enrolled'=>$enrolled]);
    }
}

