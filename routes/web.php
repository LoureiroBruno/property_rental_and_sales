<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index/Index');
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show']);

Route::resource('listing', App\Http\Controllers\ListingController::class);

Route::get('login', [App\Http\Controllers\AuthController::class, 'create'])
    ->name('login');
Route::post('login', [App\Http\Controllers\AuthController::class, 'store'])
    ->name('login.store');
Route::delete('logout', [App\Http\Controllers\AuthController::class, 'destroy'])
    ->name('logout');
