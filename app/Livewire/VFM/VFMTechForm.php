<?php

namespace App\Livewire\VFM;

use App\Models\VFM\VFM;
use App\Models\VFM\VFMVehicle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class VFMTechForm extends Component
{
    public $vfmId;
    public $date_in;
    public $date_out;
    public $state_inspection;
    public $mileage;
    public $air_filter = false;
    public $antifreeze = false;
    public $battery = false;
    public $battery_booster = false;
    public $belts = false;
    public $brake_fluid = false;
    public $brakes_front = false;
    public $brakes_rear = false;
    public $detention_equipment = false;
    public $diagnostic_scan = false;
    public $engine_oil = false;
    public $exhaust = false;
    public $hoses = false;
    public $lights = false;
    public $mirrors = false;
    public $power_steering_fluid = false;
    public $safety_restraints = false;
    public $shocks_struts = false;
    public $tires = false;
    public $transmission_fluid = false;
    public $vehicle_jump_starter = false;
    public $washer_fluid = false;
    public $window_operation = false;
    public $windshield = false;
    public $wiper_blades = false;
    public $fire_extinguisher = false;
    public $description_of_service;

    public $vehicles = [];
    public $vfm_vehicle_id;
    public $make;
    public $model;
    public $vin;
    public $license_plate;

    public function mount()
    {
        $this->vehicles = VFMVehicle::all();
    }

    public function updatedVfmVehicleId($value)
    {
        $vehicle = VFMVehicle::find($value);

        if ($vehicle) {
            $this->make = $vehicle->make;
            $this->model = $vehicle->model;
            $this->vin = $vehicle->vin;
            $this->license_plate = $vehicle->license_plate;
        } else {
            $this->make = null;
            $this->model = null;
            $this->vin = null;
            $this->license_plate = null;
        }
    }

    // Validation rules for the form
    protected function rules()
    {
        return [
            'vfm_vehicle_id' => 'required|exists:vfm_vehicle,id',
            'date_in' => 'required',
            'date_out' => 'required',
            'state_inspection' => 'required',
            'mileage' => 'required',
            'air_filter' => 'boolean',
            'antifreeze' => 'boolean',
            'battery' => 'boolean',
            'battery_booster' => 'boolean',
            'belts' => 'boolean',
            'brake_fluid' => 'boolean',
            'brakes_front' => 'boolean',
            'brakes_rear' => 'boolean',
            'detention_equipment' => 'boolean',
            'diagnostic_scan' => 'boolean',
            'engine_oil' => 'boolean',
            'exhaust' => 'boolean',
            'hoses' => 'boolean',
            'lights' => 'boolean',
            'mirrors' => 'boolean',
            'power_steering_fluid' => 'boolean',
            'safety_restraints' => 'boolean',
            'shocks_struts' => 'boolean',
            'tires' => 'boolean',
            'transmission_fluid' => 'boolean',
            'vehicle_jump_starter'=> 'boolean',
            'washer_fluid' => 'boolean',
            'window_operation' => 'boolean',
            'windshield' => 'boolean',
            'wiper_blades' => 'boolean',
            'fire_extinguisher' => 'boolean',
        ];
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

        // Create new VFM
        $vfm = new VFM;
        $vfm->maintenance_technician = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        session()->flash('create-edit-delete-message', 'VFM created successfully!');

        // Persistent data
        $vehicle = VFMVehicle::find($this->vfm_vehicle_id);
        $vfm->vehicle_make = $vehicle->make;
        $vfm->vehicle_model = $vehicle->model;
        $vfm->vehicle_year = $vehicle->vehicle_year;
        $vfm->vehicle_license_plate = $vehicle->license_plate;
        $vfm->vehicle_vin = $vehicle->vin;

        $vfm->vfm_vehicle_id = $this->vfm_vehicle_id;
        $vfm->date_in = $this->date_in;
        $vfm->date_out = $this->date_out;
        $vfm->state_inspection = $this->state_inspection;
        $vfm->mileage = $this->mileage;
        $vfm->air_filter = $this->air_filter;
        $vfm->antifreeze = $this->antifreeze;
        $vfm->battery = $this->battery;
        $vfm->battery_booster = $this->battery_booster;
        $vfm->belts = $this->belts;
        $vfm->brake_fluid = $this->brake_fluid;
        $vfm->brakes_front = $this->brakes_front;
        $vfm->brakes_rear = $this->brakes_rear;
        $vfm->detention_equipment = $this->detention_equipment;
        $vfm->diagnostic_scan = $this->diagnostic_scan;
        $vfm->engine_oil = $this->engine_oil;
        $vfm->exhaust = $this->exhaust;
        $vfm->hoses = $this->hoses;
        $vfm->lights = $this->lights;
        $vfm->mirrors = $this->mirrors;
        $vfm->power_steering_fluid = $this->power_steering_fluid;
        $vfm->safety_restraints = $this->safety_restraints;
        $vfm->shocks_struts = $this->shocks_struts;
        $vfm->tires = $this->tires;
        $vfm->transmission_fluid = $this->transmission_fluid;
        $vfm->vehicle_jump_starter = $this->vehicle_jump_starter;
        $vfm->washer_fluid = $this->washer_fluid;
        $vfm->window_operation = $this->window_operation;
        $vfm->windshield = $this->windshield;
        $vfm->wiper_blades = $this->wiper_blades;
        $vfm->fire_extinguisher = $this->fire_extinguisher;
        $vfm->description_of_service = $this->description_of_service;

        $vfm->save();

        session()->flash('message', 'VFM created successfully!');

        return redirect()->route('vfm-tech.dashboard'); // Redirect to user list
    }

    public function render()
    {
        return view('VFMTech.livewire.vfm-tech-form');
    }
}
