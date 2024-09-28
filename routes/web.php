<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PhoneDirectoryController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Index route: Display a list of phone directories for all users
Route::get('/phone-directories/all', [PhoneDirectoryController::class, 'indexAll'])->name('PhoneDirectory.indexAll');

// Index route: Display a list of phone directories
Route::get('/phone-directories', [PhoneDirectoryController::class, 'index'])->name('PhoneDirectory.index');

// Create route: Show a form to create a new phone directory entry using Livewire
Route::get('/phone-directories/create', [PhoneDirectoryController::class, 'create'])->name('PhoneDirectory.create');

// Edit route: Show a form to edit an existing entry
Route::get('/phone-directories/{id}/edit', [PhoneDirectoryController::class, 'edit'])->name('PhoneDirectory.edit');

// Login routes **************************************************************************************************************************
// Show the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Dashboard (only accessible after login)
Route::middleware(['auth'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');