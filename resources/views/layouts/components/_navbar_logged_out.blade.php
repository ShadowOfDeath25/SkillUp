@extends("layouts.components._navbar")
@section("nav-buttons")
    <li><a class="border-btn" href="#">Sign In</a> </li>
    <li><a class="border-btn" href="{{route("signup")}}">Join Us</a></li>
@endsection
