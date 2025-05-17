<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index/Index');
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show'])->middleware('auth');

Route::resource('listing', App\Http\Controllers\ListingController::class)->middleware('auth');

Route::get('login', [App\Http\Controllers\AuthController::class, 'create'])
    ->name('login');
Route::post('login', [App\Http\Controllers\AuthController::class, 'store'])
    ->name('login.store');
Route::delete('logout', [App\Http\Controllers\AuthController::class, 'destroy'])
    ->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);
