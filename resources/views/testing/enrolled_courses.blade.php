@extends("layouts.master")
@section('content')
    @foreach($courses as $course)
        <a href="{{route("edit-course.index",['course'=>$course->id])}}">{{$course->title}}</a>
    @endforeach
    @foreach($courses as $course)
        <a href="{{route("courseplay.index",['course'=>$course])}}">{{$course->title}}</a>
    @endforeach
@endsection
