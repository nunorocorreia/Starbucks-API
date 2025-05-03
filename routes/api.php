<?php
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
        'version' => '1.0.0',
    ], 200);
});
