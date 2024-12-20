@extends('layouts.master')
@section('title','Sign Up')
@section('styles')
<link rel="stylesheet" href="{{asset("css/signup.css")}}">
@endsection
@section('content')

    <div class="welcome">
        <h2>Welcome to SkillUp</h2>
    </div>
    <main>
        <div class="signup-container">
            <form class="signup-form" action="{{route("register-user")}}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="form-column">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter Your E-Mail">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Enter Your Full Name">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" placeholder="Enter Your Phone Number">
                    </div>
                    <div class="form-column">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Your Password">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm-password" placeholder="Confirm Password">
                        <div class="gender">
                            <label>Gender</label>
                            <div class="gender-options">
                                <label><input type="radio" name="gender" value="male"> Male</label>
                                <label><input type="radio" name="gender" value="female"> Female</label>
                            </div>
                        </div>
                        <p class="already-registered">Already Registered? <a href="#" class="signin-link">Sign
                                in</a></p>
                    </div>
                </div>
                <div class="errors">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="errors">
                            <i class="fa-solid fa-circle-exclamation"> error</i>

                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <button type="submit" class="signup-btn">Sign Up</button>
            </form>
        </div>
    </main>
@endsection
