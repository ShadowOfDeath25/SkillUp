<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\User_Course;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $enrollments = User_Course::where('user_id', $userId)->get();
            $courses = [];
            foreach ($enrollments as $enrollment) {
                $courses[] = $enrollment->course;
            }
            return view('enrolled_courses', ["courses" => $courses]);

        } else {
            return back()->withErrors("Please login first");
        }
    }

    public function enroll(Course $course)
    {
        if (Auth::check()) {
            try {
                if ($course->price > Auth::user()->credit){
                    return back()->withErrors("Insufficient Funds");
                }
                $user= Auth::user();
                $user->credit-= $course->price;
                $user->save();
                $enrollment = new User_Course;
                $enrollment->user_id = Auth::user()->id;
                $enrollment->course_id = $course->id;
                $enrollment->save();
                return back()->with("success","Enrollment Successful");
            } catch (\Exception $exception) {
                return back()->withErrors([$exception->getMessage()]);
            }
        } else {
            return back()->withErrors("Please login first");
        }


    }
}
