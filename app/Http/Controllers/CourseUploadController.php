<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\directoryExists;

class CourseUploadController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('upload_course');
        } else {
            return back()->withErrors("You are not allowed to access this page");
        }
    }

    public function upload()
    {
        $request = request();
        $request->validate([
            'videos' => 'required|array',
            'videos.*' => 'file|mimes:mp4,mkv,avi|max:2048000',
            'author' => 'required|email|exists:users,email',
            'title' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'time' => 'required|numeric',
            'thumb' => 'required|image|mimes:jpeg,png,jpg,svg|max:20480'
        ]);

        $uploadedFiles = [];
        try {
            $time = now()->format('y-m-d_h-i-s');
            $author = User::where('email', request('author'))->first();
            $thumbnail = $request->file('thumb');
            $tPath = $thumbnail->storeAs('thumbnails/' . $author->id . '_' . $request->title . '_' . $time, $author->id . '-' . $request->title . '.' . $thumbnail->extension(), 'public');
            $tUrl = Storage::url($tPath);
            $num = 1;
            $course = new Course;
            $course->title = $request->title;
            $course->category = $request->category;
            $course->author_id = $author->id;
            $course->thumbnail = $tUrl;
            $course->description = $request->description;
            $course->brief = $request->brief;
            $course->price = $request->price;
            $course->time = $request->time;
            $course->save();
            foreach ($request->file('videos') as $video) {
                $extension = $video->getClientOriginalExtension();
                $customFilename = $author->name . "_" . $course->title . '_' . $time . "_" . $num . "." . $extension;
                $path = $video->storeAs('videos/' . $author->id . '_' . $request->title,
                    $author->id . '_' . $request->title . '_' . $time . '_' . $num . '.' . $extension,
                    'public');
                $url = Storage::url($path);
                $newVideo = new video;
                $newVideo->title = $course->title . ' ' . $num;
                $newVideo->path = $url;
                $newVideo->course_id = $course->id;
                $newVideo->save();


                $uploadedFiles[] = [
                    'file_name' => $customFilename,
                    'file_path' => $path,
                    'file_url' => $url,
                ];
                $num++;
            }

            return redirect()->route('home.index')->with('success', 'Videos uploaded successfully');

        } catch (\Exception $e) {
            return back()->withErrors([
                'message' => 'Video upload failed!',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
