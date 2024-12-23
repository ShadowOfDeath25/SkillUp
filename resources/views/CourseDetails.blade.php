@extends("layouts.master")
@section('title',$course->title)
@section('styles')
    <link rel="stylesheet" href="{{asset('css/C_details.css')}}">
@endsection
@section('content')
    @include('layouts.components._errors')
    <div class="page">

        <div class="top">
            <div class="photo">
                <img src="{{$course->thumbnail}}" alt="web">
            </div>
            <div class="text">
                <h2>{{$course->title." - ".$course->author->name}}</h2>
                <p>{!! nl2br($course->brief) !!}</p>
                <div class="info">
                    <div class="price">
                        <span>$</span>
                        <span>{{$course->price}}</span>
                    </div>
                    <div class="hours">
                        <i class="fa-regular fa-clock"></i>
                        <span> {{$course->time}} H</span>
                    </div>
                </div>
                @if($enrolled)
                    <button class="enroll-btn-disabled" disabled>Enrolled</button>
                @else
                <button id="enrollButton" class="enroll-btn">Enroll</button>
                @endif
            </div>
        </div>
        <div class="bottom">
            <span class="d-label">Course Description:</span>
            <div class="course-description">
                <p>{!!nl2br($course->description)!!}</p>
            </div>
            <script>
                document.getElementById("enrollButton").addEventListener("click", function () {
                    if (confirm("Are you sure you want to enroll in this course?")) {
                        window.location.href = "{{ route('enrollment.create', ['course' => $course->id]) }}";
                    }
                });
            </script>

        </div>
    </div>

@endsection
