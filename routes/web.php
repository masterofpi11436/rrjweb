<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PhoneDirectoryController;

Route::get('/', function () {
    return redirect()->route('PhoneDirectory.index');
});


// Index route: Display a list of phone directories
Route::get('/phone-directories', [PhoneDirectoryController::class, 'index'])->name('PhoneDirectory.index');

// Create route: Show a form to create a new phone directory entry
Route::get('/phone-directories/create', [PhoneDirectoryController::class, 'create'])->name('PhoneDirectory.create');

// Store route: Handle POST request to store a new entry
Route::post('/phone-directories', [PhoneDirectoryController::class, 'store'])->name('PhoneDirectory.store');

// Show route: Display a single phone directory entry
Route::get('/phone-directories/{id}', [PhoneDirectoryController::class, 'show'])->name('PhoneDirectory.show');

// Edit route: Show a form to edit an existing entry
Route::get('/phone-directories/{id}/edit', [PhoneDirectoryController::class, 'edit'])->name('PhoneDirectory.edit');

// Update route: Handle PUT/PATCH request to update the entry
Route::put('/phone-directories/{id}', [PhoneDirectoryController::class, 'update'])->name('PhoneDirectory.update');

// Destroy route: Handle DELETE request to remove an entry
Route::delete('/phone-directories/{id}', [PhoneDirectoryController::class, 'destroy'])->name('PhoneDirectory.destroy');
