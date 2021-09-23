<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    // Register form
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('frontend.auth.register');
        }
    }

    // Register handler
    public function register(RegisterRequest $request)
    {
        if (User::addNewAccount($request)) {
            return redirect()->route('user.show_login_form');
        } else {
            return redirect()->back();
        }
    }

    // show form Register
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('frontend.auth.sign-in');
        }
    }

    public function login(LoginRequest $request)
    {

        $remember = $request->remember ? true : false;

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('error', 'Login failed !!!');
        }
    }

    public function logout()
    {
        if (Auth::logout()) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
}
