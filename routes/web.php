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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'books']);
Route::get('/collections/{category_slug}/{book_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'bookView']);

Route::middleware(['auth'])->group(function (){
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('readlist', [App\Http\Controllers\Frontend\ReadlistController::class, 'index']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //Home Slider Routes
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete', 'destroy');
    });


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

    //Publishers Routes
    Route::get('/publishers', App\Http\Livewire\Admin\Publisher\Index::class);

    //Users Routes
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index']);
});
