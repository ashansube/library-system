<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //Category Routes
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
    });


    //Books Routes
    Route::controller(App\Http\Controllers\Admin\BookController::class)->group(function () {
        Route::get('/books', 'index');
        Route::get('/books/create', 'create');
        Route::post('/books', 'store');
        Route::get('/books/{book}/edit', 'edit');
        Route::put('/books/{book}', 'update');
        Route::get('books/{book_id}/delete', 'destroy');
        Route::get('book-image/{book_image_id}/delete', 'destroyImage');
    });

    Route::get('/publishers', App\Http\Livewire\Admin\Publisher\Index::class);
});
