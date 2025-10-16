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
    Route::get('/fakultas', [AuthController::class, 'fakultas'])->name('fakultas.index');
    Route::get('/jurusan', [AuthController::class, 'jurusan'])->name('jurusan.index');
    Route::get('/semester', [AuthController::class, 'semester'])->name('semester.index');
    Route::get('/ruangan', [AuthController::class, 'ruangan'])->name('ruangan.index');
    Route::get('/mata_kuliah', [AuthController::class, 'mata_kuliah'])->name('mata_kuliah.index');
    Route::get('/kelas', [AuthController::class, 'kelas'])->name('kelas.index');
    Route::get('/jadwal', [AuthController::class, 'jadwal'])->name('jadwal.index');
    Route::get('/khs', [AuthController::class, 'khs'])->name('khs.index');
    Route::get('/krs', [AuthController::class, 'krs'])->name('krs.index');

});
