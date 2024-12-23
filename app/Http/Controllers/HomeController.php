<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User_Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('home', ["courses" => $courses]);
    }

    public function search()
    {
        $search = request('term');
        $courses = Course::where('title', 'LIKE', '%' . $search . '%')->get();
        return view('home', ["courses" => $courses]);
    }

    public function category($category)
    {
        $courses = Course::where('category', $category)->get();
        return view('home', ["courses" => $courses]);
    }
    
    public function test(){
        return view('test');
    }
}