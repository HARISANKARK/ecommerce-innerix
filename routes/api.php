<?php

use App\Http\Controllers\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/login', [ApiController::class, 'login']);
    Route::post('/categories', [ApiController::class, 'Categories']);
    Route::post('/products', [ApiController::class, 'Products']);
    Route::post('/carts', [ApiController::class, 'Carts']);
    Route::post('/orders', [ApiController::class, 'Orders']);
});
