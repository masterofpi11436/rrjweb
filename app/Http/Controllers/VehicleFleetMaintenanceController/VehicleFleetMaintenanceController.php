<?php

namespace App\Http\Controllers;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\FleetVehicleMaintenance\FleetVehicleMaintenance;

class VehicleFleetMaintenanceController extends Controller
{
    public function dashboard()
    {
        return view('Directory.PhoneDirectory.dashboard');
    }

    public function create()
    {
        return view('Directory.PhoneDirectory.create');
    }

    public function edit($id)
    {
        $vehicle = FleetVehicleMaintenance::findOrFail($id);
        return view('Directory.PhoneDirectory.edit', ['vehicle' => $vehicle]);
    }

    public function destroy($id)
    {
        $vehicle = FleetVehicleMaintenance::findOrFail($id);
        $vehicle->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
