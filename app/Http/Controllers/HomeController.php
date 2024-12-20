<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('testing/home', ["courses" => $courses]);
    }

    public function search()
    {
        $search = request()->term;
        $courses = Course::where('title', 'LIKE', '%' . $search . '%')->get();
        return view('testing/home', ["courses" => $courses]);

    }
}
