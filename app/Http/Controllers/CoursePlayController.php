<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User_Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursePlayController extends Controller
{
    public function index(Course $course)
    {
        if (Auth::check()) {
            try {
                $enrolled_courses = User_Course::where('user_id', Auth::user()->id)
                    ->where('course_id', $course->id)
                    ->get();
                if ($enrolled_courses->isNotEmpty()) {
                    $videos = Video::where('course_id', $course->id)->get()->sortBy('created_at');
                    return view('courseplay', ["videos" => $videos]);
                } else {
                    return back()->withErrors("You aren't enrolled in this course to watch it");
                }
            } catch (\Exception $exception) {
                return back()->withErrors("Something went wrong", $exception->getMessage());
            }
        } else {
            return back()->withErrors("You must be logged in to play this course");
        }
    }
}
