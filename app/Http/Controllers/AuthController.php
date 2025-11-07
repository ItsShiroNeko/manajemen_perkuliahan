<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User\User;
use App\Models\Role\Role;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('Login attempt', $credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $roleName = strtolower($user->role->nama_role ?? '');
            Log::info('User logged in', [
                'user_id' => $user->id,
                'role_id' => $user->role_id,
                'role_name' => $user->role->nama_role ?? null,
                'role_lowercase' => $roleName
            ]);

            return redirect()->route("{$roleName}.dashboard");
        }

        Log::warning('Login failed', ['email' => $request->email]);
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'status' => 'active',
        ]);

        Auth::login($user);

        $user = Auth::user();
        $roleName = strtolower($user->role->nama_role ?? '');
        Log::info('New user registered', [
            'user_id' => $user->id,
            'role_id' => $user->role_id,
            'role_name' => $user->role->nama_role ?? null,
            'role_lowercase' => $roleName
        ]);

        return redirect()->route("{$roleName}.dashboard");
    }

    public function logout(Request $request)
    {
        Log::info('User logout', ['user_id' => Auth::id()]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
