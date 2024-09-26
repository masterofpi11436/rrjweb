<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PhoneDirectoryController;

Route::get('/', function () {
    return redirect()->route('phone-directories.index');
});

Route::resource('phone-directories', PhoneDirectoryController::class);
