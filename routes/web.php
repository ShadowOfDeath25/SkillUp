<?php

use App\Http\Controllers\CoursePlayController;
use App\Http\Controllers\EditCourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VideoUploadController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/courseplay',function(){
    return view('courseplay');
});
Route::get('/test',function(){
    return view('testing/test');
});
Route::get("/home/search",[HomeController::class ,'search'])->name("search.index");
Route::get("/course/{course}",[CoursePlayController::class,'index'])->name("courseplay.index");
Route::get("/signup",[RegisterController::class,'index'])->name("register-page");
Route::post("/delete",[EditCourseController::class,'delete'])->name("course.delete");
Route::post("/update/{course}",[EditCourseController::class,'update'])->name("course.update");
Route::get('/home',[HomeController::class,'index'])->name('home.index');
Route::get("/edit-course/{course}",[EditCourseController::class,'index'])->name('edit-course.index');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::post('/register-user',[RegisterController::class,'register'])->name("register-user");
Route::get("/login",[LoginController::class,'index'])->name("login");
Route::post("/login-user",[LoginController::class,'login'])->name("login-user");
Route::get('/upload-video',[VideoUploadController::class,'index'])->name("upload-video");
Route::post('/upload',[VideoUploadController::class,'upload'])->name("upload");
Route::get('/signup',[RegisterController::class,'index'])->name("signup");
Route::post('/signup-user',[RegisterController::class,'register'])->name("signup-user");



