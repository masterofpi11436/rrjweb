<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;

// Models required


class AdminController extends Controller
{
    // Login Required Pages
    public function dashboard()
    {
        return view('Training.Admin.dashboard');
    }
}
