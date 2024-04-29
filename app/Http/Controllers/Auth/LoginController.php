<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email_phone', 'password');

        $fieldType = filter_var($request->email_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        if (Auth::attempt([$fieldType => $request->email_phone, 'password' => $request->password])) {
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors(['email_phone' => __('auth.failed')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
