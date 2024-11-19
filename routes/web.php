<?php

use Illuminate\Support\Facades\Route;

 //Для глобального ліміту
Route::middleware(['throttle:global'])->get('/', function () {
    return view('welcome');
});

//Route::get('/test-log', function () {
//    logger()->channel('telegram')->debug('Test message to Telegram');
//    return 'Message sent to Telegram!';
//});


// Для API ліміту
Route::middleware('throttle:api')->get('/api/user', function () {
    return response()->json(['user' => 'data']);
});
