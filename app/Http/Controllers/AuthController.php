<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // cek role
            $user = auth()->user();

            if ($user->hasRole('admin')) {
                return redirect('/admin');
            } elseif ($user->hasRole('petugas')) {
                return redirect('/petugas');
            } else {
                return redirect('/peminjam');
            }
        }

        return back()->with('error', 'Email atau password salah');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}