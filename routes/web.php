<?php

use Illuminate\Support\Facades\Route;

// Для глобального ліміту
Route::middleware(['throttle:global'])->get('/', function () {
    logger()
        ->channel('telegram')
        ->debug('Hello world');
    return view('welcome');
});




// Для API ліміту
Route::middleware('throttle:api')->get('/api/user', function () {
    return response()->json(['user' => 'data']);
});
