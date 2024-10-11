<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Tablet\InmateTabletController;
use App\Http\Controllers\Administrator\AdministratorController;

// Shorthand classes
$phoneClass = PhoneDirectoryController::class;
$tabletClass = InmateTabletController::class;
$adminClass = AdministratorController::class;

// Admin Dashboard Route
Route::get('/admin/dashboard', [$adminClass, 'dashboard'])
    ->name('admin.dashboard');

// Phone Directory Routes
Route::prefix('phone')->group(function () use ($phoneClass) {

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
Route::prefix('tablet')->group(function () use ($tabletClass) {

    Route::get('/dashboard', [$tabletClass, 'dashboard'])
        ->name('tablet.dashboard');

    Route::get('/create', [$tabletClass, 'create'])
        ->name('tablet.create');

    Route::get('/{id}/edit', [$tabletClass, 'edit'])
        ->name('tablet.edit');

    Route::delete('/{id}', [$tabletClass, 'destroy'])
        ->name('tablet.destroy');
});
