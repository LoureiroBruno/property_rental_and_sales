<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use App\Models\Listing;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page (renders Inertia view directly)
// Route::get('/', function () {
//     return inertia('Index/Index');
// });

// Home page handled by controller
// Route::get('/', [IndexController::class, 'index']);

Route::get('/', [ListingController::class, 'index']);

// Authenticated "hello" route (example/test route)
Route::get('/listing', [IndexController::class, 'show'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Public Listing Routes
|--------------------------------------------------------------------------
*/
// Show list of listings and listing details (public)
Route::resource('listing', ListingController::class)
    ->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| Offers for Listings (Authenticated Users Only)
|--------------------------------------------------------------------------
*/
// Authenticated users can make offers on listings
Route::resource('listing.offer', ListingOfferController::class)
    ->middleware('auth')
    ->only(['store']);

/*
|--------------------------------------------------------------------------
| Notifications for Authenticated Users
|--------------------------------------------------------------------------
*/
// View user notifications
Route::resource('notification', NotificationController::class)
    ->middleware('auth')
    ->only(['index']);

// Mark notification as seen
Route::put(
    'notification/{notification}/seen',
    NotificationSeenController::class
)->middleware('auth')->name('notification.seen');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
// Login form
Route::get('login', [App\Http\Controllers\AuthController::class, 'create'])
    ->name('login');

// Login submission
Route::post('login', [App\Http\Controllers\AuthController::class, 'store'])
    ->name('login.store');

// Logout
Route::delete('logout', [App\Http\Controllers\AuthController::class, 'destroy'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/

// Page asking the user to verify their email
Route::get('/email/verify', function () {
    return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

// Handle email verification link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('listing.index')
        ->with('success', 'Email was verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification link
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| User Registration Routes
|--------------------------------------------------------------------------
*/
// Create a new user account (only create/store)
Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/user-account/profile', [UserAccountController::class, 'edit'])->name('user-account.edit');
    Route::put('/user-account/{user}', [UserAccountController::class, 'update'])->name('user-account.update');
});

/*
|--------------------------------------------------------------------------
| Realtor Area (Authenticated and Verified Users Only)
|--------------------------------------------------------------------------
*/
Route::prefix('realtor')
    ->name('realtor.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        // Restore a deleted listing (soft-deleted)
        Route::name('listing.restore')
            ->put(
                'listing/{listing}/restore',
                [RealtorListingController::class, 'restore']
            )->withTrashed();

        // Manage realtor's listings (with trashed included)
        Route::resource('listing', RealtorListingController::class)
            ->withTrashed();

        // Accept an offer for a listing
        Route::name('offer.accept')
            ->put(
                'offer/{offer}/accept',
                RealtorListingAcceptOfferController::class
            );

        // Manage images for listings (create, store, delete)
        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store', 'destroy']);
    });
