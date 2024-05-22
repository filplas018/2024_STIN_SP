<?php


use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HistoryDataController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseSubmitController;
use App\Http\Controllers\SaveFavouriteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth'])->group(function () {

Route::withoutMiddleware(["auth"])->group(static function() {

    Route::get('/login', [LoginController::class, 'login'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'loginPost'])
        ->name('login.post');

    Route::get('/register', [RegisterController::class, 'register'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'registerPost'])
        ->name('register.post');
});

    Route::get('/', HomePageController::class)
        ->name('home');

    Route::post('/', SaveFavouriteController::class)
        ->name('favourite');

    Route::get('/profile', ProfileController::class)
        ->name('profile');

    Route::get('/logout', LogoutController::class)
        ->name('logout');

    Route::post('/change-password', ChangePasswordController::class)
        ->name('change-password');

    Route::post('/change-email', ChangeEmailController::class)
        ->name('change-email');

    Route::get('/purchase', \App\Http\Controllers\PurchaseController::class)
        ->name('purchase');

    Route::post('/purchase', PurchaseSubmitController::class)
        ->name('purchase.submit');

    Route::middleware(['subscriber'])->group(static function () {
        Route::get('/data', DataController::class)
            ->name('data');
    });
});
