<?php

namespace App\Http\Controllers\ICS;

// Base Controller
use App\Http\Controllers\Controller;

class ICSController extends Controller
{
    public function dashboard()
    {
        return view('ICS.Tablet.dashboard');
    }
}
