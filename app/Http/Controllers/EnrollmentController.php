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
        $userId = Auth::user()->id;
        $enrollments = User_Course::where('user_id', $userId)->get();
        $courses = [];
        foreach ($enrollments as $enrollment) {
            $courses[] = $enrollment->course;
        }
        return view('testing/enrolled_courses', ["courses" => $courses]);
    }

    public function enroll(){
        //TBD
    }
}
