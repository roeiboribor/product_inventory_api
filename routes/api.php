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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// OPEN ROUTES
Route::post('register', [V1\ApiController::class, 'register'])->name('register');
Route::post('login', [V1\ApiController::class, 'login'])->name('login');

// PROTECTED ROUTES
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('profile', [V1\ApiController::class, 'profile'])->name('profile');
    Route::get('logout', [V1\ApiController::class, 'logout'])->name('logout');
});
