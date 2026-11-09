<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_Login extends Controller
{
    // Tampil halaman login (route '/') — Part 3
    public function index()
    {
        // Kalau sudah login, arahkan sesuai level
        if (Auth::check()) {
            return $this->redirectByLevel();
        }
        return view('v_login');
    }

    // Proses login — Part 3
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib di isi !',
            'email.email' => 'Format email tidak valid !',
            'password.required' => 'Password wajib di isi !',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectByLevel();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah !',
        ])->onlyInput('email');
    }

    // Redirect sesuai level akun:
    // Level 1 = Admin -> /home
    // Level 2 = User -> /user (Data User)
    // Level 3 = Mahasiswa -> /mahasiswa
    // Level 4 = Dosen -> /dosen
    protected function redirectByLevel()
    {
        $level = Auth::user()->level;

        if ($level == 2) {
            return redirect()->intended('/user');
        } elseif ($level == 3) {
            return redirect()->intended('/mahasiswa');
        } elseif ($level == 4) {
            return redirect()->intended('/dosen');
        }

        return redirect()->intended('/home');
    }

    // Logout — Part 3
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
