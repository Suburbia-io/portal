<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
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
    Route::post('/auth', [AuthController::class, 'submitAuthForm'])->middleware('throttle:5,1');
});

// Signed Route, performs the actual login by clicking on an email link.
Route::get('/auth/login', [AuthController::class, 'loginLink'])->name('auth.login');

// Customer Portal routes
Route::middleware(['auth',])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/s3', [S3Controller::class, 'getS3Setup'])->name('s3');
    Route::post('/s3', [S3Controller::class, 'postS3Setup']);
});

// Admin Two Factor Authentication
Route::middleware(['auth', 'admin',])->group(function() {
    Route::get('/auth/two-factor', [AuthController::class, 'showTwoFactorForm'])->name('tfa');
    Route::post('/auth/two-factor', [AuthController::class, 'submitTwoFactorForm']);
});

// Admin Routes
Route::middleware(['auth', 'admin',])->group(function() {
    Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users');
    Route::post('/admin/users', [AdminController::class, 'createUser']);
    Route::get('/admin/datasets', [AdminController::class, 'getDatasets'])->name('admin.datasets');
    Route::post('/admin/datasets', [AdminController::class, 'createDataset']);
    Route::get('/admin/users/{user}', [AdminController::class, 'getUser'])->name('admin.user');
    Route::post('/admin/users/{user}', [AdminController::class, 'updateUser']);
});

// API Routes
Route::get('/api/user.datasets', [ApiController::class, 'userDatasetsApi']);
Route::post('/api/user.access', [ApiController::class, 'userAccessLogApi']);
