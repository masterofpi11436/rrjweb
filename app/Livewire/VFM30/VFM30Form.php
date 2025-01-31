<?php

namespace App\Livewire\VFM30;

use App\Models\VFM30\VFM30;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class VFM30Form extends Component
{
    public $vfmId;
    public $date_in;
    public $date_out;
    public $state_inspection;
    public $license_plate;
    public $mileage;
    public $vehicle_year;
    public $make;
    public $model;
    public $vin;

    // Safety Systems
    public $horn = false;
    public $seatbelts = false;
    public $detention_equipment = false;
    public $fire_extinguisher = false;
    public $battery_booster = false;
    public $emergency_roadside_kit = false;

    // Under the hood
    public $engine_oil = false;
    public $coolant = false;
    public $brake_fluid = false;
    public $power_steering_fluid = false;
    public $transmission_fluid = false;
    public $washer_fluid = false;
    public $air_filter = false;
    public $belts_and_hoses = false;
    public $battery = false;

    // Drivetrain
    public $diagnostic_scan = false;
    public $driveshaft_cv_joints_u_joints = false;
    public $exhaust = false;
    public $brakes = false;

    // Interior and Exterior
    public $body_and_paint = false;
    public $lights = false;
    public $a_c_systems = false;
    public $windshield_wipers = false;
    public $windshield = false;
    public $window_operation = false;
    public $mirrors = false;

    // Suspension
    public $tires = false;
    public $tire_air_pressure = false;
    public $shock_Struts = false;
    public $ball_joints_and_bushings = false;

    public $description_of_service;
    public $is_outside_service_required = false;
    public $outside_service_required;
    public $outside_service_po;

    // Validation rules for the form
    protected function rules()
    {
        return [
            'date_in' => 'required|date',
            'date_out' => 'required|date',
            'state_inspection' => 'required|date',
            'license_plate' => 'required|string',
            'mileage' => 'required|integer',
            'vehicle_year' => 'required|integer',
            'make' => 'required|string',
            'model' => 'required|string',
            'vin' => 'required|string',

            // Safety Systems
            'horn' => 'boolean',
            'seatbelts' => 'boolean',
            'detention_equipment' => 'boolean',
            'fire_extinguisher' => 'boolean',
            'battery_booster' => 'boolean',
            'emergency_roadside_kit' => 'boolean',

            // Under the Hood
            'engine_oil' => 'boolean',
            'coolant' => 'boolean',
            'brake_fluid' => 'boolean',
            'power_steering_fluid' => 'boolean',
            'transmission_fluid' => 'boolean',
            'washer_fluid' => 'boolean',
            'air_filter' => 'boolean',
            'belts_and_hoses' => 'boolean',
            'battery'=> 'boolean',

            // Drivetrain
            'diagnostic_scan' => 'boolean',
            'driveshaft_cv_joints_u_joints' => 'boolean',
            'exhaust' => 'boolean',
            'brakes' => 'boolean',

            // Interior and Exterior
            'body_and_paint' => 'boolean',
            'lights' => 'boolean',
            'a_c_systems' => 'boolean',
            'windshield_wipers' => 'boolean',
            'windshield' => 'boolean',
            'window_operation' => 'boolean',
            'mirrors' => 'boolean',

            // Suspension
            'tires' => 'boolean',
            'tire_air_pressure' => 'boolean',
            'shock_Struts' => 'boolean',
            'ball_joints_and_bushings' => 'boolean',

            'description_of_service' => 'nullable|string',
            'is_outside_service_required' => 'boolean',
            'outside_service_required' => 'nullable|string',
            'outside_service_po' => 'nullable|string',
        ];
    }

        // Method to load existing data if editing
    public function mount($id = null)
    {
        if ($id) {
            $vfm = VFM30::findOrFail($id);
            $this->vfmId = $vfm->id;
            $this->date_in = $vfm->date_in;
            $this->date_out = $vfm->date_out;
            $this->state_inspection = $vfm->state_inspection;
            $this->license_plate = $vfm->license_plate;
            $this->mileage = $vfm->mileage;
            $this->vehicle_year = $vfm->vehicle_year;
            $this->make = $vfm->make;
            $this->model = $vfm->model;
            $this->vin = $vfm->vin;

            // Safety Systems
            $this->horn = $vfm->horn;
            $this->seatbelts = $vfm->seatbelts;
            $this->detention_equipment = $vfm->detention_equipment;
            $this->fire_extinguisher = $vfm->fire_extinguisher;
            $this->battery_booster = $vfm->battery_booster;
            $this->emergency_roadside_kit = $vfm->emergency_roadside_kit;

            // Under the Hood
            $this->engine_oil = $vfm->engine_oil;
            $this->coolant = $vfm->coolant;
            $this->brake_fluid = $vfm->brake_fluid;
            $this->power_steering_fluid = $vfm->power_steering_fluid;
            $this->transmission_fluid = $vfm->transmission_fluid;
            $this->washer_fluid = $vfm->washer_fluid;
            $this->air_filter = $vfm->air_filter;
            $this->belts_and_hoses = $vfm->belts_and_hoses;
            $this->battery = $vfm->battery;

            // Drivetrain
            $this->diagnostic_scan = $vfm->diagnostic_scan;
            $this->driveshaft_cv_joints_u_joints = $vfm->driveshaft_cv_joints_u_joints;
            $this->exhaust = $vfm->exhaust;
            $this->brakes = $vfm->brakes;

            // Interior and Exterior
            $this->body_and_paint = $vfm->body_and_paint;
            $this->lights = $vfm->lights;
            $this->a_c_systems = $vfm->a_c_systems;
            $this->windshield_wipers = $vfm->windshield_wipers;
            $this->windshield = $vfm->windshield;
            $this->window_operation = $vfm->window_operation;
            $this->mirrors = $vfm->mirrors;

            // Suspension
            $this->tires = $vfm->tires;
            $this->tire_air_pressure = $vfm->tire_air_pressure;
            $this->shock_Struts = $vfm->shock_Struts;
            $this->ball_joints_and_bushings = $vfm->ball_joints_and_bushings;

            $this->description_of_service = $vfm->description_of_service;
            $this->is_outside_service_required = $vfm->is_outside_service_required;
            $this->outside_service_required = $vfm->outside_service_required;
            $this->outside_service_po = $vfm->outside_service_po;
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

        if ($this->vfmId) {
            $vfm = VFM30::find($this->vfmId);
            session()->flash('create-edit-delete-message', 'VFM updated successfully!');
        } else {
            // Create new VFM
            $vfm = new VFM30;
            $vfm->maintenance_technician = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            session()->flash('create-edit-delete-message', 'VFM created successfully!');
        }

        $vfm->date_in = $this->date_in;
        $vfm->date_out = $this->date_out;
        $vfm->state_inspection = $this->state_inspection;
        $vfm->license_plate = $this->license_plate;
        $vfm->mileage = $this->mileage;
        $vfm->vehicle_year = $this->vehicle_year;
        $vfm->make = $this->make;
        $vfm->model = $this->model;
        $vfm->vin = $this->vin;

        // Safety Systems
        $vfm->horn = $this->horn;
        $vfm->seatbelts = $this->seatbelts;
        $vfm->detention_equipment = $this->detention_equipment;
        $vfm->fire_extinguisher = $this->fire_extinguisher;
        $vfm->battery_booster = $this->battery_booster;
        $vfm->emergency_roadside_kit = $this->emergency_roadside_kit;

        // Under the H
        $vfm->engine_oil = $this->engine_oil;
        $vfm->coolant = $this->coolant;
        $vfm->brake_fluid = $this->brake_fluid;
        $vfm->power_steering_fluid = $this->power_steering_fluid;
        $vfm->transmission_fluid = $this->transmission_fluid;
        $vfm->washer_fluid = $this->washer_fluid;
        $vfm->air_filter = $this->air_filter;
        $vfm->belts_and_hoses = $this->belts_and_hoses;
        $vfm->battery = $this->battery;

        // Drivetrain
        $vfm->diagnostic_scan = $this->diagnostic_scan;
        $vfm->driveshaft_cv_joints_u_joints = $this->driveshaft_cv_joints_u_joints;
        $vfm->exhaust = $this->exhaust;
        $vfm->brakes = $this->brakes;

        // Interior and Exterior
        $vfm->body_and_paint = $this->body_and_paint;
        $vfm->lights = $this->lights;
        $vfm->a_c_systems = $this->a_c_systems;
        $vfm->windshield_wipers = $this->windshield_wipers;
        $vfm->windshield = $this->windshield;
        $vfm->window_operation = $this->window_operation;
        $vfm->mirrors = $this->mirrors;

        // Suspension
        $vfm->tires = $this->tires;
        $vfm->tire_air_pressure = $this->tire_air_pressure;
        $vfm->shock_Struts = $this->shock_Struts;
        $vfm->ball_joints_and_bushings = $this->ball_joints_and_bushings;

        $vfm->description_of_service = $this->description_of_service;
        $vfm->is_outside_service_required = $this->is_outside_service_required;
        $vfm->outside_service_required = $this->outside_service_required;
        $vfm->outside_service_po = $this->outside_service_po;

        $vfm->save();

        session()->flash('message', $this->vfmId ? 'VFM updated successfully!' : 'VFM created successfully!');

        return redirect()->route('vfm30.dashboard');
    }

    public function render()
    {
        return view('VFM30.livewire.vfm30-form');
    }
}
