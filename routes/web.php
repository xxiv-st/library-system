
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', [BookController::class, 'index'])
    ->name('books.index');

Route::get('/books/create', [BookController::class, 'create'])
    ->name('books.create');

Route::post('/books', [BookController::class, 'store'])
    ->name('books.store');

Route::get('/books/{book}/edit', [BookController::class, 'edit'])
    ->name('books.edit');

Route::put('/books/{book}', [BookController::class, 'update'])
    ->name('books.update');

Route::delete('/books/{book}', [BookController::class, 'destroy'])
    ->name('books.destroy');

Route::get('/books/{id}', [BookController::class, 'show'])
    ->name('books.show');

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/members', [MemberController::class, 'index']);
Route::get('/members/{id}', [MemberController::class, 'show']);
Route::get('/dashboard', [DashboardController::class, 'index']);
