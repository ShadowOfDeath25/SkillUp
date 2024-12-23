<?php

use App\Http\Controllers\CourseDetailsController;
use App\Http\Controllers\CoursePlayController;
use App\Http\Controllers\EditCourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CourseUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/test',[HomeController::class,'test'])->name('test');



Route::get("/enroll/{course}",[EnrollmentController::class,'enroll'])->name("enrollment.create");
Route::get("/course-details/{course}",[CourseDetailsController::class,'index'])->name('course-details.index');
Route::get('/enrolled-courses', [EnrollmentController::class, 'index'])->name('enrolled.index');
Route::get("/home/search",[HomeController::class ,'search'])->name("search.index");
Route::get("/home/{category}",[HomeController::class ,'category'])->name("home.category");
Route::get("/course-player/{course}",[CoursePlayController::class,'index'])->name("course-player.index");
Route::get("/signup",[RegisterController::class,'index'])->name("register-page");
Route::post("/delete",[EditCourseController::class,'delete'])->name("course.delete");
Route::post("/update/{course}",[EditCourseController::class,'update'])->name("course.update");
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get("/edit-course/{course}",[EditCourseController::class,'index'])->name('edit-course.index');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::post('/register-user',[RegisterController::class,'register'])->name("register-user");
Route::get("/login",[LoginController::class,'index'])->name("login");
Route::post("/login-user",[LoginController::class,'login'])->name("login-user");
Route::get('/course-uploader',[CourseUploadController::class,'index'])->name("course-uploader.index");
Route::post('/upload',[CourseUploadController::class,'upload'])->name("course-uploader.upload");
Route::get('/signup',[RegisterController::class,'index'])->name("signup");
Route::post('/signup-user',[RegisterController::class,'register'])->name("signup-user");



