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

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {

    Route::get('/','index');
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}', 'books');
    Route::get('/collections/{category_slug}/{book_slug}', 'bookView');
    Route::get('/new-arrivals', 'newArrival');
    Route::get('/featured-books', 'featuredBooks');

    Route::get('search', 'searchBooks');

});

Route::middleware(['auth'])->group(function (){
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('readlist', [App\Http\Controllers\Frontend\ReadlistController::class, 'index']);
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::get('checkoutreadlist', [App\Http\Controllers\Frontend\CheckoutReadlistController::class, 'index']);

    // Orders
    //Cart Orders
    Route::get('cartorders', [App\Http\Controllers\Frontend\CartOrderController::class, 'index']);
    Route::get('cartorders/{cartorderId}', [App\Http\Controllers\Frontend\CartOrderController::class, 'show']);

    //Readlist Orders
    Route::get('readlistorders', [App\Http\Controllers\Frontend\ReadlistOrderController::class, 'index']);
    Route::get('readlistorders/{readlistorderId}', [App\Http\Controllers\Frontend\ReadlistOrderController::class, 'show']);

    //User Profile Routes
    Route::get('profile', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails']);
    //Change Password
    Route::get('change-password', [App\Http\Controllers\Frontend\UserController::class, 'passwordCreate']);
    Route::post('change-password', [App\Http\Controllers\Frontend\UserController::class, 'changePassword']);
});

Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Admin Routes

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
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{userId}/edit', 'edit');
        Route::put('users/{userId}', 'update');
        Route::get('users/{userId}/delete', 'destroy');
        //Send SMS
        Route::get('/users/{userId}/sendsms', 'getSMSDeta');
        Route::post('/users/sendsms', 'sendSMS');
    });

    //Orders Routes
    // Cart Order Routes
    Route::controller(App\Http\Controllers\Admin\CartOrderController::class)->group(function () {
        Route::get('/cartorders', 'index');
        Route::get('/cartorders/{cartorderId}', 'show');
        Route::put('/cartorders/{cartorderId}', 'updateOrderStatus');

        //Generate Invoice Cart Orders
        Route::get('/cartinvoice/{cartorderId}', 'viewInvoice');
        Route::get('/cartinvoice/{cartorderId}/generate', 'generateInvoice');
        //Send Cart Invoice Mail
        Route::get('/cartinvoice/{cartorderId}/cartmail', 'mailInvoice');
    });

     // Read List Order Routes
    Route::controller(App\Http\Controllers\Admin\ReadlistOrderController::class)->group(function () {
        Route::get('/readlistorders', 'index');
        Route::get('/readlistorders/{readlistorderId}', 'show');
        Route::put('/readlistorders/{readlistorderId}', 'updateOrderStatus');

        //Generate Invoice Read List Orders (Libraray Invoice)
        Route::get('/readlistinvoice/{readlistorderId}', 'viewInvoice');
        Route::get('/readlistinvoice/{readlistorderId}/generate', 'generateInvoice');
    });

});
