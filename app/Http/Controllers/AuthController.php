<?php

// Cara Membuat Controller di Laravel
// php artisan make:controller AuthController

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::Attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }; 

        return back()->with('error', 'Email atau Password Salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
