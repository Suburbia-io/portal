<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\S3Controller;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function() {
    if (!auth()->check()) {
        return redirect()->route('auth');
    }
    return redirect()->route('dashboard');
});

// Authentication routes, sends out the auth email with login link.
Route::middleware(['guest',])->group(function () {
    Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth');
    Route::post('/auth', [AuthController::class, 'submitAuthForm'])->middleware('throttle:5,2');
});

// Signed Route, performs the actual login by clicking on an email link.
Route::get('/auth/login', [AuthController::class, 'loginLink'])->name('auth.login');

Route::middleware(['auth', 'admin',])->group(function() {
    Route::get('/auth/two-factor', [AuthController::class, 'showTwoFactorForm'])->name('tfa');
    Route::post('/auth/two-factor', [AuthController::class, 'submitTwoFactorForm']);
});

// Customer Portal routes
Route::middleware(['auth',])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');
    Route::get('/s3', [S3Controller::class, 'getS3Setup'])->name('s3');
    Route::post('/s3', [S3Controller::class, 'postS3Setup']);
});

// Admin Routes
Route::middleware(['auth', 'admin', 'tfa',])->group(function() {

});
