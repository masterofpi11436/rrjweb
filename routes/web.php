<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Tablet\InmateTabletController;

$phoneClass = PhoneDirectoryController::class;
$tabletClass = InmateTabletController::class;

Route::get('/', function () {
    return redirect('/tablet/dashboard');
});

// Index All route: Public list of phone directory for all users
Route::get('/phone-directory/all', [$phoneClass, 'indexAll']);

// Administrative routes for phone directory
Route::prefix('phone')->group(function () use ($phoneClass){
    
    // Index route: Phone directory dashboard
    Route::get('/dashboard', [$phoneClass, 'dashboard'])
        ->name('phone.dashboard');

    // Create route: Show a form to create a new phone directory entry
    Route::get('/create', [$phoneClass, 'create'])
        ->name('phone.create');

    // Edit route: Show a form to edit an existing entry
    Route::get('/{id}/edit', [$phoneClass, 'edit'])
        ->name('phone.edit');
    
    // Destroy route: Delete an existing record
    Route::delete('/{id}', [$phoneClass, 'destroy'])
        ->name('phone.destroy');

});

// Administrative routes for inmate tablets
Route::prefix('tablet')->group(function () use ($tabletClass){

    // Index route: Inmate tablet dashboard
    Route::get('/dashboard', [$tabletClass, 'dashboard'])
        ->name('tablet.dashboard');

    // Create route: Create a new record
    Route::get('/create', [$tabletClass, 'create'])
        ->name('tablet.create');

    // Edit route: Edit an existing record
    Route::get('/{id}/edit', [$tabletClass, 'edit'])
        ->name('tablet.edit');
    
    // Destroy route: Delete an existing record
    Route::delete('/{id}', [$tabletClass, 'destroy'])
        ->name('tablet.destroy');
});