<?php

use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//require __DIR__.'/auth.php';

Route::get('/', [ProductController::class, 'index']);

Route::prefix('/product')->name('products.')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        // ??? why this is not working when it is placed last in group ???
        Route::get('/create', 'create')
            ->name('create');

        Route::post('/create', 'store')
            ->name('create');

        Route::get('/{product}', 'show')
            ->name('show');

        Route::get('/{product}/edit', 'edit')
            ->name('edit');
    });
});

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::get('/cart/{user}', [CartController::class, 'customerCart'])->name('cart.customer');

//Route::get('/vuejs', function () {
//    return view('vuejs');
//})->name('vuejs');

Route::view('/vuejs', 'vuejs');

// make full length url work under vue-router
Route::view('/vue-shop{any?}', 'vue-shop')->where('any', '.*');
