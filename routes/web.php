<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Tablet\InmateTabletController;

Route::get('/', function () {
    return redirect('/inmate-tablet/index');
});

// Index All route: Public list of phone directory for all users
Route::get('/phone-directory/all', [PhoneDirectoryController::class, 'indexAll'])
        ->name('Directory.PhoneDirectory.indexAll');

// Administrative routes for phone directory
Route::prefix('phone-directory')->group(function () {
    
    // Index route: Phone directory dashboard
    Route::get('/index', [PhoneDirectoryController::class, 'index'])
        ->name('Directory.PhoneDirectory.index');

    // Create route: Show a form to create a new phone directory entry
    Route::get('/create', [PhoneDirectoryController::class, 'create'])
        ->name('Directory.PhoneDirectory.create');

    // Edit route: Show a form to edit an existing entry
    Route::get('/{id}/edit', [PhoneDirectoryController::class, 'edit'])
        ->name('Directory.PhoneDirectory.edit');
});

// Administrative routes for inmate tablets
Route::prefix('inmate-tablet')->group(function () {

    // Index route: Inmate tablet dashboard
    Route::get('/index', [InmateTabletController::class, 'index'])
        ->name('Tablet.InmateTablet.index');

    // Create route: Create a new entry
    Route::get('/create', [InmateTabletController::class, 'create'])
        ->name('Tablet.InmateTablet.create');

    // Edit route: Edit an existing entry
    Route::get('/{id}/edit', [InmateTabletController::class, 'edit'])
        ->name('Tablet.InmateTablet.edit');
});
