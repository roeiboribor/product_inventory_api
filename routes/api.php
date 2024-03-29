<?php

use App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:api'], 'as' => 'api.'], function () {
    Orion::resource('products', V1\ProductController::class)->withSoftDeletes();
    Orion::resource('categories', V1\CategoryController::class)->withSoftDeletes();

    Orion::belongsToResource('products', 'category', V1\ProductCategoryController::class);
    Orion::hasManyResource('categories', 'products', V1\CategoryProductsController::class);

    Route::post('/products/adjust-stock', [V1\ProductController::class, 'adjustStock'])->name('products.adjust-stock');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION - ROUTES
|--------------------------------------------------------------------------
|
| Here is where authentication related routes
|
*/

Route::post('register', [V1\RegisterController::class, 'store']);
Route::post('login', [V1\AuthenticatedController::class, 'store']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('profile', [V1\ProfileController::class, 'profile']);
    Route::post('logout', [V1\AuthenticatedController::class, 'destroy'])->name('logout');
});
