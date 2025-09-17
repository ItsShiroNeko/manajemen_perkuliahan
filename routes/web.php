<?php

use App\Http\Controllers\AuthController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // bikin view dashboard.blade.php
    })->name('dashboard');

    // Tambah route lain di sini (hanya untuk user login)
});
