<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Login\AdminLoginController;
use App\Http\Controllers\Login\PhoneLoginController;
use App\Http\Controllers\Login\TabletLoginController;
use App\Http\Controllers\Tablet\InmateTabletController;
use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Administrator\AdministratorController;

// Shorthand classes
$phoneClass = PhoneDirectoryController::class;
$tabletClass = InmateTabletController::class;
$adminClass = AdministratorController::class;

// User Authentication for Admin application
Route::get('admin/login', [AdminLoginController::class, 'adminLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// User Authentication for Phone application
Route::get('phone/login', [PhoneLoginController::class, 'phoneLoginForm'])->name('phone.login');
Route::post('phone/login', [PhoneLoginController::class, 'login'])->name('phone.login.submit');
Route::post('phone/logout', [PhoneLoginController::class, 'logout'])->name('phone.logout');

// User Authentication for Tablet application
Route::get('tablet/login', [TabletLoginController::class, 'tabletLoginForm'])->name('tablet.login');
Route::post('tablet/login', [TabletLoginController::class, 'login'])->name('tablet.login.submit');
Route::post('tablet/logout', [TabletLoginController::class, 'logout'])->name('tablet.logout');


// Admin Dashboard Route
Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::prefix('admin')->middleware('check.authorization:admin')->group(function () use ($adminClass) {

    Route::get('/dashboard', [$adminClass, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/index', [$adminClass, 'index'])
        ->name('admin.index');

    Route::get('/create', [$adminClass, 'create'])
        ->name('admin.create');

    Route::get('/{id}/edit', [$adminClass, 'edit'])
        ->name('admin.edit');

    Route::delete('/{id}', [$adminClass, 'destroy'])
        ->name('admin.destroy');
});

// Phone Directory Routes with Middleware
Route::prefix('phone')->middleware('check.authorization:phone')->group(function () use ($phoneClass) {

    Route::get('/dashboard', [$phoneClass, 'dashboard'])
        ->name('phone.dashboard');

    Route::get('/create', [$phoneClass, 'create'])
        ->name('phone.create');

    Route::get('/{id}/edit', [$phoneClass, 'edit'])
        ->name('phone.edit');

    Route::delete('/{id}', [$phoneClass, 'destroy'])
        ->name('phone.destroy');
});

// Tablet Management Routes
Route::prefix('tablet')->middleware('check.authorization:tablet')->group(function () use ($tabletClass) {

    Route::get('/dashboard', [$tabletClass, 'dashboard'])
        ->name('tablet.dashboard');

    Route::get('/create', [$tabletClass, 'create'])
        ->name('tablet.create');

    Route::get('/{id}/edit', [$tabletClass, 'edit'])
        ->name('tablet.edit');

    Route::delete('/{id}', [$tabletClass, 'destroy'])
        ->name('tablet.destroy');
});
