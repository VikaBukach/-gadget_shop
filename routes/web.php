<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

 //Для глобального ліміту
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['throttle:global'])->controller(\App\Http\Controllers\AuthController::class)->group(function (){
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'signIn')->name('signIn');
    Route::get('/sign-up', 'signUp')->name('signUp');
    Route::post('/sign-up', 'store')->name('store');
    Route::delete('/logout', 'logOut')->name('logOut');

});


// Для API ліміту
Route::middleware('throttle:api')->get('/api/user', function () {
    return response()->json(['user' => 'data']);
});
