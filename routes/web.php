<?php

use Illuminate\Support\Facades\Route;

 //Для глобального ліміту
Route::middleware(['throttle:global'])->get(\App\Http\Controllers\HomeController::class)->name('home');

Route::middleware(['throttle:global'])->controller(\App\Http\Controllers\AuthController::class)->group(function (){
    Route::get('/login', 'index')->name('login');
    Route::get('/sign-up', 'signUp')->name('signUp');


});


// Для API ліміту
Route::middleware('throttle:api')->get('/api/user', function () {
    return response()->json(['user' => 'data']);
});
