<?php

namespace App\Livewire\VFM;

use App\Models\VFM\VFMVehicle;
use Livewire\Component;

class VFMTechVehicleForm extends Component
{
    public $vfmVehicleId;
    public $license_plate;
    public $vehicle_year;
    public $make;
    public $model;
    public $vin;

    // Validation rules for the form
    protected function rules()
    {
        return [
            'license_plate' => 'required',
            'vehicle_year' => 'required',
            'make' => 'required',
            'model' => 'required',
            'vin' => 'required',
        ];
    }

    // Method to load existing data if editing
    public function mount($id = null)
    {
        if ($id) {
            $vfmVehicle = VFMVehicle::findOrFail($id);
            $this->vfmVehicleId = $vfmVehicle->id;
            $this->license_plate = $vfmVehicle->license_plate;
            $this->vehicle_year = $vfmVehicle->vehicle_year;
            $this->make = $vfmVehicle->make;
            $this->model = $vfmVehicle->model;
            $this->vin = $vfmVehicle->vin;
        }
    }

    // For live validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Handle the form submission
    public function submitForm()
    {
        $this->validate();

        if ($this->vfmVehicleId) {
            $vfmVehicle = VFMVehicle::find($this->vfmVehicleId);
            session()->flash('create-edit-delete-message', 'Vehicle information updated successfully!');
        } else {
            // Create new VFM
            $vfmVehicle = new VFMVehicle;
            session()->flash('create-edit-delete-message', 'Vehicle information created successfully!');
        }

        $vfmVehicle->license_plate = $this->license_plate;
        $vfmVehicle->vehicle_year = $this->vehicle_year;
        $vfmVehicle->make = $this->make;
        $vfmVehicle->model = $this->model;
        $vfmVehicle->vin = $this->vin;

        $vfmVehicle->save();

        session()->flash('message', $this->vfmVehicleId ? 'Vehicle information updated successfully!' : 'Vehicle information created successfully!');

        return redirect()->route('vfm-tech.vehicle.dashboard');
    }

    public function render()
    {
        return view('VFMTech.livewire.vfm-tech-vehicle-form');
    }
}
