<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login-page');
    }

    public function login(Request $request)
    {
        // 1. Validasi Input (Kuat & Strict)
        $credentials = $request->validate([
            'email' => 'required|email:dns|exists:tuser,email',
            'password' => 'required|string|min:8',
        ], [
            'email.exists' => 'Kredensial tidak ditemukan.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.'

        ]);

        // 2. Attempt Login dengan Remember Me
        $remember = $request->has('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Mencegah Session Fixation
            return redirect()->intended('/admin/dashboard')
                             ->with('SA-success', 'Selamat Datang, ' . Auth::user()->name);
        }

        // 3. Jika gagal, lempar error balik
        throw ValidationException::withMessages([
            'email' => 'Email atau Password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // CSRF Protection
        return redirect()->route('auth.login-page');
    }

    public function errors() {
        return view('errors.404');
    }
}
