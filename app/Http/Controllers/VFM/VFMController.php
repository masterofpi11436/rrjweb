<?php

namespace App\Http\Controllers\VFM;

// Base Controller
use App\Http\Controllers\Controller;

class VFMController extends Controller
{
    public function dashboard()
    {
        return view('VFM.VFM.dashboard');
    }
}
