
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route yang hanya bisa diakses pengguna yang belum login
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

});

// Route yang hanya bisa diakses pengguna yang sudah login
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Modul Buku
    Route::resource('books', BookController::class);

    // Modul Kategori
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    // Modul Anggota
    Route::get('/members', [MemberController::class, 'index'])
        ->name('members.index');

    Route::get('/members/{id}', [MemberController::class, 'show'])
        ->name('members.show');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});

// Route khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Hanya admin yang boleh mengelola akun pengguna.
    // Route::resource('users', UserController::class);

});
