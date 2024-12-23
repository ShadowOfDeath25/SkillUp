<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\User_Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\confirm;

class EditCourseController extends Controller
{
    public function index(Course $course)
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return view('edit_course', ['course' => $course]);
        } else {
            return back()->withErrors("You are not allowed to access this page");
        }
    }

    public function delete()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            try {
                $course = Course::find(request()->course);
                $videos = Video::where('course_id', $course->id)->get();
                $dir = dirname($videos[0]->path);
                $dir = substr($dir, 1);
                File::deleteDirectory($dir);
                File::deleteDirectory(substr(dirname($course->thumbnail), 1));
                $enrolled = User_Course::where('course_id', $course->id)->get();
                if ($enrolled->isNotEmpty()) {
                    $enrolled->each->delete();
                }
                $videos->each->delete();
                $course->delete();
                return redirect()->route('home.index')->with('success', 'Course deleted');
            } catch (\Exception $e) {
                return back()->withErrors($e->getMessage());
            }
        } else {
            return back()->withErrors("You are not allowed to access this page");
        }

    }

    public function update(Course $course)
    {
        if (Auth::user() && Auth::user()->role === 'admin') {
            $request = request();
            $request->validate([
                'videos' => 'array',
                'videos.*' => 'file|mimes:mp4,mkv,avi|max:2048000',
                'author' => 'required|email|exists:users,email',
                'title' => 'required',
                'category' => 'required',
                'price' => 'required|numeric',
                'time' => 'required|numeric',
                'thumb' => 'image|mimes:jpeg,png,jpg,svg|max:20480'
            ]);
            try {
                $author = User::where('email', $request->author)->get()->first();
                $time = now()->format('y-m-d_h-i-s');
                $course->author_id = $author->id;
                $course->title = $request->title;
                $course->category = $request->category;
                $course->price = $request->price;
                $course->time = $request->time;
                if ($request->hasFile('thumb')) {
                    File::deleteDirectory(substr(dirname($course->thumbnail), 1));
                    $thumbnail = $request->file('thumb');
                    $path = $thumbnail->storeAs('thumbnails/' . $author->id . '_' . $request->title, $author->id . '-' . $request->title . '.' . $thumbnail->extension(), 'public');
                    $url = Storage::url($path);
                    $course->thumbnail = $url;
                }
                $num = 1;
                if ($request->hasFile('videos')) {
                    foreach ($request->videos as $video) {
                        $extension = $video->getClientOriginalExtension();
                        $path = $video->storeAs('videos/' . $author->id . '_' . $request->title,
                            $author->id . '_' . $request->title . '_' . $time . '_' . $num . '.' . $extension,
                            'public');
                        $url = Storage::url($path);
                        $newVideo = new video;
                        $newVideo->title = $course->title . ' ' . $num;
                        $newVideo->path = $url;
                        $newVideo->course_id = $course->id;
                        $newVideo->save();
                        $num++;
                    }
                }
                $course->save();
                return redirect()->route('home.index')->with('success', 'Course updated successfully');
            } catch (\Exception $e) {
                return back()->withErrors($e->getMessage());
            }

        } else {
            return back()->withErrors("You are not allowed to access this page");
        }


    }


}
