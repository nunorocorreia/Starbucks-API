<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\DrinkController;
use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Now create something great!
|
*/

Route::apiResource('drinks', DrinkController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('orders', OrderController::class);


