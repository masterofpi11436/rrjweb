<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Login\Custom\BaseLoginController;
use App\Http\Controllers\Login\Custom\AdminLoginController;
use App\Http\Controllers\Login\Custom\PhoneLoginController;
use App\Http\Controllers\Login\Custom\TabletLoginController;
use App\Http\Controllers\Login\Custom\OPRListLoginController;
use App\Http\Controllers\Login\Google\GoogleLoginController;
use App\Http\Controllers\Administrator\AdministratorController;
use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Tablet\InmateTabletController;
use App\Http\Controllers\OPR\OPRListController;

// Shorthand classes
$googleLoginClass = GoogleLoginController::class;
$baseLoginClass = BaseLoginController::class;
$adminClass = AdministratorController::class;
$adminLoginClass = AdminLoginController::class;
$phoneClass = PhoneDirectoryController::class;
$phoneLoginClass = PhoneLoginController::class;
$tabletClass = InmateTabletController::class;
$tabletLoginClass = TabletLoginController::class;
$oprListClass = OPRListController::class;
$oprListLoginClass = OPRListLoginController::class;

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
    return redirect()->route('oprList.login');
});

// Public Routes
Route::get('/phone-directory', [$phoneClass, 'phoneDirectory']);
Route::get('/inmate-tablets', [$tabletClass, 'inmateTablets']);

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

// User Authentication for Tablet Application
Route::prefix('tablet')->group(function () use ($tabletClass, $tabletLoginClass){

    // Routes without middleware
    Route::get('/login', [$tabletLoginClass, 'tabletLoginForm'])->name('tablet.login');
    Route::post('/login', [$tabletLoginClass, 'login']);
    Route::get('/forgot', [$tabletLoginClass, 'tabletForgotPasswordForm'])->name('tablet.forgot.form');
    Route::post('/forgot', [$tabletLoginClass, 'forgotPassword'])->name('tablet.forgot.form.submit');
    Route::post('/logout', [$tabletLoginClass, 'logout'])->name('tablet.logout');

    // Routes with 'tablet' middleware
    Route::middleware('tablet')->group(function () use ($tabletClass) {
        Route::get('/dashboard', [$tabletClass, 'dashboard'])->name('tablet.dashboard');
        Route::get('/create', [$tabletClass, 'create'])->name('tablet.create');
        Route::get('/{id}/edit', [$tabletClass, 'edit'])->name('tablet.edit');
        Route::delete('/{id}', [$tabletClass, 'destroy'])->name('tablet.destroy');
    });
});

// User Authentication for OPR List Application
Route::prefix('oprList')->group(function () use ($oprListClass, $oprListLoginClass){

    // Routes without middleware
    Route::get('/login', [$oprListLoginClass, 'oprListLoginForm'])->name('oprList.login');
    Route::post('/login', [$oprListLoginClass, 'login']);
    Route::get('/forgot', [$oprListLoginClass, 'oprListForgotPasswordForm'])->name('oprList.forgot.form');
    Route::post('/forgot', [$oprListLoginClass, 'forgotPassword'])->name('oprList.forgot.form.submit');
    Route::post('/logout', [$oprListLoginClass, 'logout'])->name('oprList.logout');

    // Routes with 'opr_list' middleware
    Route::middleware('oprList')->group(function () use ($oprListClass) {
        Route::get('/dashboard', [$oprListClass, 'dashboard'])->name('oprList.dashboard')->middleware('cache');
        Route::get('/create', [$oprListClass, 'create'])->name('oprList.create');
        Route::get('/{id}/edit', [$oprListClass, 'edit'])->name('oprList.edit');
        Route::delete('/{id}', [$oprListClass, 'destroy'])->name('oprList.destroy');
    });
});
