<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function index()
    {
        return view("signup");
    }

    public function register()
    {
        request()->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required|unique:users,phone|max:11',
            'confirm-password' => 'required|same:password'
        ]);

        try {
       $newUser = new User;
       $newUser->email = request('email');
       $newUser->password = Hash::make(request('password'));
       $newUser->name = request('name');
       $newUser->phone = request('phone');
       $newUser->gender = request()->input('gender');
       $newUser->save();
       Auth::attempt(['email' => request('email'), 'password' => request('password')]);
       session()->regenerate();
       return redirect()->route("home.index")->with("success", "Registration Successful");
        }catch (\Exception $exception){
            return back()->withErrors(["error" => "Registration Failed".$exception->getMessage()]);

        }
    }
}

