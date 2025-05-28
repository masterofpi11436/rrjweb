<?php

namespace App\Http\Controllers\VFM;

// Base Controller
use App\Models\VFM\VFM;
use App\Http\Controllers\Controller;

class VFMTechController extends Controller
{
    public function dashboard()
    {
        return view('VFMTech.VFM-Tech.vfm-tech-dashboard');
    }

    public function create()
    {
        return view('VFMTech.VFM-Tech.vfm-tech-create');
    }

    public function show($id)
    {
        $VFM = VFM::findOrFail($id);

        return view('VFMTech.VFM-Tech.show', compact('VFM'));
    }
}
