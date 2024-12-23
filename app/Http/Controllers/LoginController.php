<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        request()->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            session()->regenerate();
            return redirect()->route('home.index');
        } else {
            return back()->withErrors([
                'login' => 'Wrong Email or Password',
            ])->withInput();
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
