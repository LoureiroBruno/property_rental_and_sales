<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index/Index');
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show'])->middleware('auth');

// Route::resource('listing', ListingController::class)
//     ->only(['index', 'show']); o que vai valer
Route::resource('listing', App\Http\Controllers\ListingController::class)->middleware('auth');
// Route::resource('listing', App\Http\Controllers\ListingController::class)
//     ->only(['create, store, edit, update'])
//     ->middleware('auth');
// Route::resource('listing', App\Http\Controllers\ListingController::class)
//     ->only(['create, store, edit, update, destroy']);


Route::get('login', [App\Http\Controllers\AuthController::class, 'create'])
    ->name('login');
Route::post('login', [App\Http\Controllers\AuthController::class, 'store'])
    ->name('login.store');
Route::delete('logout', [App\Http\Controllers\AuthController::class, 'destroy'])
    ->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);


Route::prefix('realtor')
    ->name('realtor.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::name('listing.restore')
            ->put(
                'listing/{listing}/restore',
                [RealtorListingController::class, 'restore']
            )->withTrashed();
        Route::resource('listing', RealtorListingController::class)
            // ->only(['index', 'destroy', 'edit', 'update', 'create', 'store'])
            ->withTrashed();

        Route::name('offer.accept')
            ->put(
                'offer/{offer}/accept',
                RealtorListingAcceptOfferController::class
            );

        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store', 'destroy']);
    });
