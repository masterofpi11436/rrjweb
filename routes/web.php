<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PhoneDirectoryController;

Route::get('/', function () {
    return redirect()->route('PhoneDirectory.index');
});


Route::get('/phone-directories', [PhoneDirectoryController::class, 'index'])->name('PhoneDirectory.index');