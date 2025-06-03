<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            // Redirect based on role if already logged in
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dokter.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('pasien.dashboard');
            }
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect based on role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dokter.dashboard')->with('success', $remember 
                    ? 'Anda telah berhasil login sebagai Admin dengan Remember Me aktif!' 
                    : 'Anda telah berhasil login sebagai Admin!');
            } elseif ($user->role === 'user') {
                return redirect()->route('pasien.dashboard')->with('success', $remember 
                    ? 'Anda telah berhasil login sebagai User dengan Remember Me aktif!' 
                    : 'Anda telah berhasil login sebagai User!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout!');
    }
}