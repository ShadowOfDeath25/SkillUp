@extends("layouts.master")
@section('title','Home')
@section('styles')
    <link rel="stylesheet" href="{{asset("css/home.css")}}">
@endsection
@section('content')
    @include('layouts.components._errors')
    <div class="container">
        @foreach($courses as $course)
            <div  class="photo-link">
                <div class="image-container">
                    <img src="{{$course->thumbnail}}" alt="{{$course->title}}">
                    <div class="title-overlay">
                        <h3>{{$course->title}}</h3>
                    </div>
                    <div class="hover-overlay">
                        <div class="button-container">
                            <a href="{{route('course-details.index',['course'=>$course])}}" class="overlay-btn">More Details</a>
                            @if(Auth::check() && Auth::user()->role==='admin')
                            <a href="{{route('edit-course.index',['course'=>$course])}}" class="overlay-btn">Edit Course</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
