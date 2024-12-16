<?php

namespace App\Http\Controllers\VFM;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\VFM\VFM;

class VFMTechController extends Controller
{
    public function dashboard()
    {
        return view('VFM.VFM.tech-dashboard');
    }

    public function create()
    {
        return view('VFM.VFM.tech-create');
    }
}
