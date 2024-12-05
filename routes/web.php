<?php

use App\Http\Controllers\HomeController;
use App\Notifications\NewUserNotification;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use models\users\User;

//Для глобального ліміту
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['throttle:global'])->controller(\App\Http\Controllers\AuthController::class)->group(function (){
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'signIn')->name('signIn');
    Route::get('/sign-up', 'signUp')->name('signUp');
    Route::post('/sign-up', 'store')->name('store');
    Route::delete('/logout', 'logOut')->name('logOut');

    Route::get('/forgot-password', 'forgot')
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', 'forgotPassword')
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}','reset')
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', 'resetPassword')
        ->middleware('guest')
        ->name('password.update');

});


// Для API ліміту
Route::middleware('throttle:api')->get('/api/user', function () {
    return response()->json(['user' => 'data']);
});

//Route::get('/test', function () {
//    Mail::raw('повідомлення', function ($mail) {
//        $mail->to('віка@test.test')
//            ->subject('Заголовок');
//    });
//});
