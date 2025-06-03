<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
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
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role for new users
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        // Redirect based on role
        if ($user->role === 'user') {
            return redirect()->route('pasien.dashboard')->with('success', 'Registrasi berhasil! Anda telah login sebagai User.');
        }

        // Fallback redirect (in case role is not user, though unlikely)
        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }
}