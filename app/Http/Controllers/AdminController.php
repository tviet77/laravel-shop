<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('admin.home');
        }
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        if (auth()->attempt([
            'email' => $request->username,
            'password' => $request->password
        ])) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }
}
