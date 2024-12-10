<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Login\Custom\BaseLoginController;
use App\Http\Controllers\Login\Custom\AdminLoginController;
use App\Http\Controllers\Login\Custom\PhoneLoginController;
use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Login\Custom\VFMLoginController;
use App\Http\Controllers\Login\Google\GoogleLoginController;
use App\Http\Controllers\Administrator\AdministratorController;

use App\Http\Controllers\VFM\VFMController;

// Shorthand classes
$googleLoginClass = GoogleLoginController::class;
$baseLoginClass = BaseLoginController::class;
$adminClass = AdministratorController::class;
$adminLoginClass = AdminLoginController::class;
$phoneClass = PhoneDirectoryController::class;
$phoneLoginClass = PhoneLoginController::class;
$vfmClass = VFMController::class;
$vfmLoginClass = VFMLoginController::class;

// Unified route for Google login that includes application type as a parameter
Route::get('{app}/google-login', [$googleLoginClass, 'googleLogin'])
    ->where('app', 'admin|phone|tablet|oprList') // Limits the allowed values for app
    ->name('google.login');

// Unified callback route for all applications to login
Route::get('google-callback', [$googleLoginClass, 'googleAuthentication'])->name('google.callback');

// Forgot password link for all applications
Route::get('forgot', [$baseLoginClass, 'showForgotPasswordForm'])->name('login.forgot');
Route::post('forgot', [$baseLoginClass, 'forgotPassword'])->name('login.forgot.form');

Route::get('/password/reset/{token}', [$baseLoginClass, 'showResetForm'])->name('login.reset');
Route::post('/password/reset', [$baseLoginClass, 'reset'])->name('login.update');
Route::view('/login/success', 'Login.Resets.success')->name('login.success');

// Default Redirect Route for testing
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Public Routes
Route::get('/phone-directory', [$phoneClass, 'phoneDirectory']);

// Admin Routes
Route::prefix('admin')->group(function () use ($adminClass, $adminLoginClass) {

    // Routes without middleware
    Route::get('/login', [$adminLoginClass, 'adminLoginForm'])->name('admin.login');
    Route::post('/login', [$adminLoginClass, 'login']);
    Route::get('/forgot', [$adminLoginClass, 'adminForgotPasswordForm'])->name('admin.forgot.form');
    Route::post('/forgot', [$adminLoginClass, 'forgotPassword'])->name('admin.forgot.form.submit');
    Route::post('/logout', [$adminLoginClass, 'logout'])->name('admin.logout');

    // Routes with 'admin' middleware
    Route::middleware('admin')->group(function () use ($adminClass) {
        Route::get('/dashboard', [$adminClass, 'dashboard'])->name('admin.dashboard')->middleware('cache');
        Route::get('/index', [$adminClass, 'index'])->name('admin.index');
        Route::get('/create', [$adminClass, 'create'])->name('admin.create');
        Route::get('/{id}/edit', [$adminClass, 'edit'])->name('admin.edit');
        Route::delete('/{id}', [$adminClass, 'destroy'])->name('admin.destroy');
    });
});

// User Authentication for Phone Application
Route::prefix('phone')->group(function () use ($phoneClass, $phoneLoginClass){

    // Routes without middleware
    Route::get('/login', [$phoneLoginClass, 'phoneLoginForm'])->name('phone.login');
    Route::post('/login', [$phoneLoginClass, 'login']);
    Route::get('/forgot', [$phoneLoginClass, 'phoneForgotPasswordForm'])->name('phone.forgot.form');
    Route::post('/forgot', [$phoneLoginClass, 'forgotPassword'])->name('phone.forgot.form.submit');
    Route::post('/logout', [$phoneLoginClass, 'logout'])->name('phone.logout');

    // Routes with 'phone' middleware
    Route::middleware('phone')->group(function () use ($phoneClass) {
        Route::get('/dashboard', [$phoneClass, 'dashboard'])->name('phone.dashboard');
        Route::get('/create', [$phoneClass, 'create'])->name('phone.create');
        Route::get('/{id}/edit', [$phoneClass, 'edit'])->name('phone.edit');
        Route::delete('/{id}', [$phoneClass, 'destroy'])->name('phone.destroy');
    });
});

// User Authentication for Vehicle Fleet Maintenance Application
Route::prefix('vfm')->group(function () use ($vfmClass, $vfmLoginClass){

    // Routes without middleware
    Route::get('/login', [$vfmLoginClass, 'vfmLoginForm'])->name('vfm.login');
    Route::post('/login', [$vfmLoginClass, 'login']);
    Route::get('/forgot', [$vfmLoginClass, 'vfmForgotPasswordForm'])->name('vfm.forgot.form');
    Route::post('/forgot', [$vfmLoginClass, 'forgotPassword'])->name('vfm.forgot.form.submit');
    Route::post('/logout', [$vfmLoginClass, 'logout'])->name('vfm.logout');

    // Routes with 'vfm' middleware
    Route::middleware('vfm')->group(function () use ($vfmClass) {
        Route::get('/dashboard', [$vfmClass, 'dashboard'])->name('vfm.dashboard');
        Route::get('/create', [$vfmClass, 'create'])->name('vfm.create');
        Route::get('/{id}/edit', [$vfmClass, 'edit'])->name('vfm.edit');
        Route::delete('/{id}', [$vfmClass, 'destroy'])->name('vfm.destroy');
    });
});
