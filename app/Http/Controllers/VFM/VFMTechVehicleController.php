<?php

namespace App\Http\Controllers\VFM;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\VFM\VFMVehicle;

class VFMTechVehicleController extends Controller
{
    public function dashboard()
    {
        return view('VFMTech.VFM-Tech.vehicle-dashboard');
    }

    public function create()
    {
        return view('VFMTech.VFM-Tech.create-vehicle');
    }

    public function edit($id)
    {
        $vfm = VFMVehicle::findOrFail($id);
        return view('VFMTech.VFM-Tech.vfm-tech-edit-vehicle', ['vfm' => $vfm]);
    }

    public function destroy($id)
    {
        $vfm = VFMVehicle::findOrFail($id);
        $vfm->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
