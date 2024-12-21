<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseDetailsController extends Controller
{
    public function index(Course $course){
        return view('testing/course_details',['course'=>$course]);
    }
}

