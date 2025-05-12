<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index/Index');
});

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/hello', [App\Http\Controllers\IndexController::class, 'show']);

Route::resource('listing', ListingController::class);
