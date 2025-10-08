<?php

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/role', [AuthController::class, 'role'])->name('role.index');
    Route::get('/user', [AuthController::class, 'user'])->name('user.index');
    Route::get('/mahasiswa', [AuthController::class, 'mahasiswa'])->name('mahasiswa.index');
    Route::get('/mahasiswa_detail/{id}', [AuthController::class, 'mahasiswa_detail'])->name('mahasiswa_detail.index');
    Route::get('/dosen', [AuthController::class, 'dosen'])->name('dosen.index');
    Route::get('/dosen_detail/{id}', [AuthController::class, 'dosen_detail'])->name('dosen_detail.index');

});
