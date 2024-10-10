<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Tablet\InmateTabletController;
use App\Http\Controllers\Administrator\AdministratorController;

// Shorthand classes
$loginClass = LoginController::class;
$phoneClass = PhoneDirectoryController::class;
$tabletClass = InmateTabletController::class;
$adminClass = AdministratorController::class;

Route::get('/admin/login', function () {
    return view('Login.admin-login');
})->name('admin.login');

// Admin Dashboard Route
Route::get('/admin/dashboard', [$adminClass, 'dashboard'])
    ->middleware(['auth', 'user.authorization:Administrator'])
    ->name('admin.dashboard');

// Phone Directory Routes
Route::prefix('phone')->group(function () use ($phoneClass) {

    Route::get('/dashboard', [$phoneClass, 'dashboard'])
        ->middleware(['auth', 'user.authorization:Manager'])
        ->name('phone.dashboard');

    Route::get('/create', [$phoneClass, 'create'])
        ->middleware(['auth', 'user.authorization:Manager'])
        ->name('phone.create');

    Route::get('/{id}/edit', [$phoneClass, 'edit'])
        ->middleware(['auth', 'user.authorization:Manager'])
        ->name('phone.edit');

    Route::delete('/{id}', [$phoneClass, 'destroy'])
        ->middleware(['auth', 'user.authorization:Manager'])
        ->name('phone.destroy');
});

// Tablet Management Routes
Route::prefix('tablet')->group(function () use ($tabletClass) {

    Route::get('/dashboard', [$tabletClass, 'dashboard'])
        ->middleware(['auth', 'user.authorization:Supervisor'])
        ->name('tablet.dashboard');

    Route::get('/create', [$tabletClass, 'create'])
        ->middleware(['auth', 'user.authorization:Supervisor'])
        ->name('tablet.create');

    Route::get('/{id}/edit', [$tabletClass, 'edit'])
        ->middleware(['auth', 'user.authorization:Supervisor'])
        ->name('tablet.edit');

    Route::delete('/{id}', [$tabletClass, 'destroy'])
        ->middleware(['auth', 'user.authorization:Supervisor'])
        ->name('tablet.destroy');
});
