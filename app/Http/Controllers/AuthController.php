<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (auth()->check()) {
            return redirect()->route('admin-projects');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt([
            'login' => $request->login,
            'password' => $request->password
        ], $request->remember)) {
            return redirect()->route('admin-projects');
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль'
        ])->onlyInput('login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login-form');
    }
}
