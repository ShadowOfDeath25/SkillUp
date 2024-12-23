@extends("layouts.master")
@section('title','Sign In')
@section('styles')
    <link rel="stylesheet" href="{{asset("css/login.css")}}"
@endsection
@section('content')
    <div class="page">
        <div class="container">
            <h1>Welcome to SkillUp</h1>
            <form action="{{route("login-user")}}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{old("email")}}" placeholder="Enter Your E-mail" required>
                <label for="pass">Password</label>
                <input id="pass" name="password" type="password" placeholder="Enter Your Password" required>
                <div class="sign-up">
                    <p>New Here?</p>
                    <a href="{{route("signup")}}">Sign Up</a>
                </div>
                @include("layouts.components._errors")
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
@endsection

