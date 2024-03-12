<?php

use App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// OPEN ROUTES
Route::post('register', [V1\RegisterController::class, 'store']);
Route::post('login', [V1\AuthenticatedController::class, 'store']);

// PROTECTED ROUTES
Route::group(['middleware' => ['auth:api']], function () {
    // Route::get('profile', [V1\UserAuthController::class, 'profile'])->name('profile');
    Route::post('logout', [V1\AuthenticatedController::class, 'destroy'])->name('logout');
});
