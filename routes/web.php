<?php

use Illuminate\Support\Facades\Route;

 //Для глобального ліміту
Route::middleware(['throttle:global'])->get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['throttle:global'])->get('/login', function () {
    return view('auth.index');
})->name('login');

// Для API ліміту
Route::middleware('throttle:api')->get('/api/user', function () {
    return response()->json(['user' => 'data']);
});
