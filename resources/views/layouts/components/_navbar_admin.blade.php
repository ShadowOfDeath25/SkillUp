@extends("layouts.components._navbar")
@section("nav-buttons")
    <li><a class="link" href="{{route('course-uploader.index')}}">Add Courses</a></li>
    @parent
@endsection
