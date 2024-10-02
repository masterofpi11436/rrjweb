<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;

// Base Controller
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    public function dashboard()
    {
        return view('Administrator.dashboard');
    }
}
