<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User\User;


class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Tampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','confirmed','min:6'],
        ]);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Tampilkan form lupa password
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function role()
    {
        return view('role.index');
    }
    public function user()
    {
        return view('user.index');
    }
    public function mahasiswa()
    {
        return view('mahasiswa.index');
    }
    public function mahasiswa_detail($id)
    {
        return view('mahasiswa_detail.index');
    }
    public function dosen()
    {
        return view('dosen.index');
    }
    public function dosen_detail($id)
    {
        return view('dosen_detail.index');
    }
    public function fakultas()
    {
        return view('fakultas.index');
    }
    public function jurusan()
    {
        return view('jurusan.index');
    }
    public function semester()
    {
        return view('semester.index');
    }
    public function ruangan()
    {
        return view('ruangan.index');
    }
    public function mata_kuliah()
    {
        return view('mata_kuliah.index');
    }
    public function kelas()
    {
        return view('kelas.index');
    }
    public function jadwal()
    {
        return view('jadwal.index');
    }
    public function khs()
    {
        return view('khs.index');
    }
    public function krs()
    {
        return view('krs.index');
    }
}
