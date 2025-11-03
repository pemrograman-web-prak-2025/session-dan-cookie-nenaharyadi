<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Hanya untuk Tamu / Guest)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome'); // Tambahkan ->name('welcome')

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

});


/*
|--------------------------------------------------------------------------
| Rute Terlindungi (Harus Login / "Remember Me" aktif)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- CRUD Postingan ---
    
    // Create
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);

    // Update
    Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{id}', [PostController::class, 'update']);

    // Delete
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

});