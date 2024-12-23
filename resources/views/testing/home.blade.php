@extends("layouts.master")
@section('content')
        @foreach($courses as $course)
            <a href="{{route("course-details.index",['course'=>$course->id])}}">{{$course->title}}</a>
        @endforeach
@endsection
