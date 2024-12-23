@extends("layouts.master")
@section('title','Sign In')
@section('styles')
    <link rel="stylesheet" href="{{asset("css/login.css")}}"
@endsection
@section('content')
    <div class="page">
        <h1>Welcome to SkillUp</h1>
        <div class="container">
            <form action="{{route("login-user")}}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="inputs">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{old("email")}}"
                               placeholder="Enter Your E-mail">
                        <label for="pass">Password</label>
                        <input id="pass" name="password" type="password" placeholder="Enter Your Password">
                    </div>
                    <div class="sign-up">
                        <span>New Here?</span>
                        <a href="{{route("signup")}}">Sign Up</a>
                    </div>
                    @include("layouts.components._errors")
                    <button type="submit">Sign In</button>
                </div>
            </form>
        </div>
    </div>
@endsection

