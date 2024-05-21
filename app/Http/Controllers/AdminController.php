<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function login()
    {
//        dd(bcrypt('admin'));
        if (auth()->check()) {
            return redirect()->route('admin.home');
        }
        return view('admin.auth.login');
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

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return redirect()->route('admin.profile');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('admin.profile');
    }
}
