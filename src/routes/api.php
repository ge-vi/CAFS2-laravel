<?php

use App\Http\Controllers\Api\V1\ProductCategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    ////////// product (CRUD task)
    Route::get('/product/{product}', [ProductController::class, 'show']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::delete('/product/{product}', [ProductController::class, 'destroy']);
    Route::patch('/product/{product}', [ProductController::class, 'update']);
    ////////// products (filter task)
    Route::get('/products', [ProductController::class, 'allProducts']);
    Route::get('/products/{active}', [ProductController::class, 'activeProducts']);
    Route::get('/products/{active}/{category}', [ProductController::class, 'productsByCategory']);
    // @see laravel route pattern or/and ->where()

    ////////// categories
    Route::get('/categories', [ProductCategoryController::class, 'allCategories']);

    // {category} - should match param. name in controller method `show`
    // this way `Route Model Binding` will work
    Route::get('/categories/{category}', [ProductCategoryController::class, 'show']);

    Route::get('/search', [ProductController::class, 'search']);
});
