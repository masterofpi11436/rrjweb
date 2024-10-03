<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Directory\PhoneDirectoryController;
use App\Http\Controllers\Tablet\InmateTabletController;
use App\Http\Controllers\Administrator\AdministratorController;

use App\Http\Middleware\CheckUserRole;

$loginClass = LoginController::class;
$phoneClass = PhoneDirectoryController::class;
$tabletClass = InmateTabletController::class;
$adminClass = AdministratorController::class;

Route::get('/', function () {
    return redirect()->route('login', ['app' => 'admin']);
});

// Login Routes
Route::get('/{app}/login', [$loginClass, 'showLoginForm'])->name('login');
Route::post('/{app}/login', [$loginClass, 'login']);
Route::post('/{app}/logout', [$loginClass, 'logout'])->name('logout');

// Dashboard Route: Applications and Users Administrative dashboard
Route::get('/admin/dashboard', [$adminClass, 'dashboard'])
    ->middleware(['auth', 'checkUserRole:1'])
    ->name('admin.dashboard');

// IndexAll route: Public list of phone directory for all users
Route::get('/phone-directory/all', [$phoneClass, 'indexAll']);

// Administrative routes for phone directory
Route::prefix('phone')->middleware(['auth', 'checkUserRole:1,2'])->group(function () use ($phoneClass){
    
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
Route::prefix('tablet')->middleware(['auth', 'checkUserRole:1,3'])->group(function () use ($tabletClass){

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