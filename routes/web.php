<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Directory\PhoneDirectoryController;

Route::get('/', function () {
    return redirect('/phone-directory');
});

// Index All route: Public list of phone directory for all users
Route::get('/phone-directory/all', [PhoneDirectoryController::class, 'indexAll'])
        ->name('Directory.PhoneDirectory.indexAll');

// Group for routes that will require authentication later
Route::prefix('phone-directory')->group(function () {
    
    // Index route: Display a list of phone directories
    Route::get('/', [PhoneDirectoryController::class, 'index'])
        ->name('Directory.PhoneDirectory.index');

    // Create route: Show a form to create a new phone directory entry
    Route::get('/create', [PhoneDirectoryController::class, 'create'])
        ->name('Directory.PhoneDirectory.create');

    // Edit route: Show a form to edit an existing entry
    Route::get('/{id}/edit', [PhoneDirectoryController::class, 'edit'])
        ->name('Directory.PhoneDirectory.edit');
});