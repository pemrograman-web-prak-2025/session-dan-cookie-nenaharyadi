<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// tampil semua postingan user
Route::get('/posts/create', [PostController::class, 'create']); // form tambah
Route::post('/posts', [PostController::class, 'store']); // simpan postingan baru

// 1. Rute untuk MENAMPILKAN form edit
Route::get('/posts/{id}/edit', [PostController::class, 'edit']);

// 2. Rute untuk MENYIMPAN perubahan (update)
Route::put('/posts/{id}', [PostController::class, 'update']);

// 3. Rute untuk MENGHAPUS postingan
Route::delete('/posts/{id}', [PostController::class, 'destroy']);