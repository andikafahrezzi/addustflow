<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }

        // ⬇️ PENTING: definisikan user SEBELUM dipakai
        $user = Auth::user();

        // Cegah login user nonaktif
        if (!$user || !$user->is_active) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun Anda dinonaktifkan oleh admin.',
            ]);
        }

        // Regenerasi session (security)
        $request->session()->regenerate();
                audit_log(
            'login',
            'auth',
            'User login: ' . $user->email
        );


        return redirect()->intended('/dashboard');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        audit_log(
            'logout',
            'auth',
            'User logout'
        );


        return redirect('/login');
    }
}
