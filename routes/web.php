<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PhoneDirectoryController;

Route::get('/', function () {
    return redirect('/phone-directories/all');
});

// Index route: Display a list of phone directories for all users
Route::get('/phone-directories/all', [PhoneDirectoryController::class, 'indexAll'])->name('PhoneDirectory.indexAll');

// Index route: Display a list of phone directories
Route::get('/phone-directories', [PhoneDirectoryController::class, 'index'])->name('PhoneDirectory.index');

// Create route: Show a form to create a new phone directory entry using Livewire
Route::get('/phone-directories/create', [PhoneDirectoryController::class, 'create'])->name('PhoneDirectory.create');

// Edit route: Show a form to edit an existing entry
Route::get('/phone-directories/{id}/edit', [PhoneDirectoryController::class, 'edit'])->name('PhoneDirectory.edit');