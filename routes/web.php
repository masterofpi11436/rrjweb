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

// Login routes **************************************************************************************************************************
// Show the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Dashboard (only accessible after login)
Route::middleware(['auth'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Group all phone directory routes under 'auth' and 'admin' middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/phone-directories', [PhoneDirectoryController::class, 'index'])->name('PhoneDirectory.index');
    Route::get('/phone-directories/create', [PhoneDirectoryController::class, 'create'])->name('PhoneDirectory.create');
    Route::get('/phone-directories/{id}/edit', [PhoneDirectoryController::class, 'edit'])->name('PhoneDirectory.edit');
});