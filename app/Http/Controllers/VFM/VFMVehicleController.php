<?php

namespace App\Http\Controllers\VFM;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\VFM\VFM;

class VFMVehicleController extends Controller
{
    public function dashboard()
    {
        return view('VFM.VFM.vehicle-dashboard');
    }

    public function create()
    {
        return view('VFM.VFM.create-vehicle');
    }

    public function edit($id)
    {
        $vfm = VFM::findOrFail($id);
        return view('VFM.VFM.edit-vehicle', ['vfm' => $vfm]);
    }

    public function destroy($id)
    {
        $vfm = VFM::findOrFail($id);
        $vfm->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
