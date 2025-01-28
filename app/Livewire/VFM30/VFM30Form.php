<?php

namespace App\Livewire\VFM30;

use App\Models\VFM\VFM30;
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
    public $horn_checked_no_service_required = false;
    public $horn_checked_service_completed = false;
    public $seatbelts_checked_no_service_required = false;
    public $seatbelts_checked_service_completed = false;
    public $detention_equipment_checked_no_service_required = false;
    public $detention_equipment_checked_service_completed = false;
    public $fire_extinguisher_checked_no_service_required = false;
    public $fire_extinguisher_checked_service_completed = false;
    public $battery_booster_checked_no_service_required = false;
    public $battery_booster_checked_service_completed = false;
    public $emergency_roadside_kit_checked_no_service_required = false;
    public $emergency_roadside_kit_checked_service_completed = false;

    // Under the hood
    public $engine_oil_checked_no_service_required = false;
    public $engine_oil_checked_service_completed = false;
    public $coolant_checked_no_service_required = false;
    public $coolant_checked_service_completed = false;
    public $brake_fluid_checked_no_service_required = false;
    public $brake_fluid_checked_service_completed = false;
    public $power_steering_fluid_checked_no_service_required = false;
    public $power_steering_fluid_checked_service_completed = false;
    public $transmission_fluid_checked_no_service_required = false;
    public $transmission_fluid_checked_service_completed = false;
    public $washer_fluid_checked_no_service_required = false;
    public $washer_fluid_checked_service_completed = false;
    public $air_filter_checked_no_service_required = false;
    public $air_filter_checked_service_completed = false;
    public $belts_and_hoses_checked_no_service_required = false;
    public $belts_and_hoses_checked_service_completed = false;
    public $battery_checked_no_service_required = false;
    public $battery_checked_service_completed = false;

    // Drivetrain
    public $diagnostic_scan_checked_no_service_required = false;
    public $diagnostic_scan_checked_service_completed = false;
    public $driveshaft_cv_joints_u_joints_checked_no_service_required = false;
    public $driveshaft_cv_joints_u_joints_checked_service_completed = false;
    public $exhaust_checked_no_service_required = false;
    public $exhaust_checked_service_completed = false;
    public $brakes_checked_no_service_required = false;
    public $brakes_checked_service_completed = false;

    // Interior and Exterior
    public $body_and_paint_checked_no_service_required = false;
    public $body_and_paint_checked_service_completed = false;
    public $lights_checked_no_service_required = false;
    public $lights_checked_service_completed = false;
    public $ac_systems_checked_no_service_required = false;
    public $ac_systems_checked_service_completed = false;
    public $windshield_wipers_checked_no_service_required = false;
    public $windshield_wipers_checked_service_completed = false;
    public $windshield_checked_no_service_required = false;
    public $windshield_checked_service_completed = false;
    public $window_operation_checked_no_service_required = false;
    public $window_operation_checked_service_completed = false;
    public $mirrors_checked_no_service_required = false;
    public $mirrors_checked_service_completed = false;

    // Suspension
    public $tires_checked_no_service_required = false;
    public $tires_checked_service_completed = false;
    public $tire_air_pressure_checked_no_service_required = false;
    public $tire_air_pressure_checked_service_completed = false;
    public $shocks_struts_checked_no_service_required = false;
    public $shocks_struts_checked_service_completed = false;
    public $ball_joints_and_bushings_checked_no_service_required = false;
    public $ball_joints_and_bushings_checked_service_completed = false;
    public $description_of_service;
    public $is_outside_service_required = false;
    public $outside_service_required;
    public $outside_service_po;

    // Validation rules for the form
    protected function rules()
    {
        return [
            'date_in' => 'required',
            'date_out' => 'required',
            'state_inspection' => 'required',
            'license_plate' => 'required',
            'mileage' => 'required',
            'vehicle_year' => 'required',
            'make' => 'required',
            'model' => 'required',
            'vin' => 'required',

            // Safety Systems
            'horn_checked_no_service_required' => 'boolean',
            'horn_checked_service_completed' => 'boolean',
            'seatbelts_checked_no_service_required' => 'boolean',
            'seatbelts_checked_service_completed' => 'boolean',
            'detention_equipment_checked_no_service_required' => 'boolean',
            'detention_equipment_checked_service_completed' => 'boolean',
            'fire_extinguisher_checked_no_service_required' => 'boolean',
            'fire_extinguisher_checked_service_completed' => 'boolean',
            'battery_booster_checked_no_service_required' => 'boolean',
            'battery_booster_checked_service_completed' => 'boolean',
            'emergency_roadside_kit_checked_no_service_required' => 'boolean',
            'emergency_roadside_kit_checked_service_completed' => 'boolean',

            // Under the Hood
            'engine_oil_checked_no_service_required' => 'boolean',
            'engine_oil_checked_service_completed' => 'boolean',
            'coolant_checked_no_service_required' => 'boolean',
            'coolant_checked_service_completed' => 'boolean',
            'brake_fluid_checked_no_service_required' => 'boolean',
            'brake_fluid_checked_service_completed' => 'boolean',
            'power_steering_fluid_checked_no_service_required' => 'boolean',
            'power_steering_fluid_checked_service_completed' => 'boolean',
            'transmission_fluid_checked_no_service_required'=> 'boolean',
            'transmission_fluid_checked_service_completed' => 'boolean',
            'washer_fluid_checked_no_service_required' => 'boolean',
            'washer_fluid_checked_service_completed' => 'boolean',
            'air_filter_checked_no_service_required' => 'boolean',
            'air_filter_checked_service_completed' => 'boolean',
            'belts_and_hoses_checked_no_service_required' => 'boolean',
            'belts_and_hoses_checked_service_completed' => 'boolean',
            'battery_checked_no_service_required' => 'boolean',
            'battery_checked_service_completed' => 'boolean',

            // Drivetrain
            'diagnostic_scan_checked_no_service_required' => 'boolean',
            'diagnostic_scan_checked_service_completed' => 'boolean',
            'driveshaft_cv_joints_u_joints_checked_no_service_required' => 'boolean',
            'driveshaft_cv_joints_u_joints_checked_service_completed' => 'boolean',
            'exhaust_checked_no_service_required' => 'boolean',
            'exhaust_checked_service_completed' => 'boolean',
            'brakes_checked_no_service_required' => 'boolean',
            'brakes_checked_service_completed' => 'boolean',

            // Interior and Exterior
            'body_and_paint_checked_no_service_required' => 'boolean',
            'body_and_paint_checked_service_completed' => 'boolean',
            'lights_checked_no_service_required' => 'boolean',
            'lights_checked_service_completed' => 'boolean',
            'ac_systems_checked_no_service_required' => 'boolean',
            'ac_systems_checked_service_completed' => 'boolean',
            'windshield_wipers_checked_no_service_required' => 'boolean',
            'windshield_wipers_checked_service_completed' => 'boolean',
            'windshield_checked_no_service_required' => 'boolean',
            'windshield_checked_service_completed' => 'boolean',
            'window_operation_checked_no_service_required' => 'boolean',
            'window_operation_checked_service_completed' => 'boolean',
            'mirrors_checked_no_service_required' => 'boolean',
            'mirrors_checked_service_completed' => 'boolean',

            // Suspension
            'tires_checked_no_service_required' => 'boolean',
            'tires_checked_service_completed' => 'boolean',
            'tire_air_pressure_checked_no_service_required' => 'boolean',
            'tire_air_pressure_checked_service_completed' => 'boolean',
            'shocks_struts_checked_no_service_required' => 'boolean',
            'shocks_struts_checked_service_completed' => 'boolean',
            'ball_joints_and_bushings_checked_no_service_required' => 'boolean',
            'ball_joints_and_bushings_checked_service_completed' => 'boolean',
            'description_of_service' => 'string',
            'is_outside_service_required' => 'boolean',
            'outside_service_required' => 'boolean',
            'outside_service_po' => 'string',
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
            $this->horn_checked_no_service_required = $vfm->horn_checked_no_service_required;
            $this->horn_checked_service_completed = $vfm->horn_checked_service_completed;
            $this->seatbelts_checked_no_service_required = $vfm->seatbelts_checked_no_service_required;
            $this->seatbelts_checked_service_completed = $vfm->seatbelts_checked_service_completed;
            $this->detention_equipment_checked_no_service_required = $vfm->detention_equipment_checked_no_service_required;
            $this->detention_equipment_checked_service_completed = $vfm->detention_equipment_checked_service_completed;
            $this->fire_extinguisher_checked_no_service_required = $vfm->fire_extinguisher_checked_no_service_required;
            $this->fire_extinguisher_checked_service_completed = $vfm->fire_extinguisher_checked_service_completed;
            $this->battery_booster_checked_no_service_required = $vfm->battery_booster_checked_no_service_required;
            $this->battery_booster_checked_service_completed = $vfm->battery_booster_checked_service_completed;
            $this->emergency_roadside_kit_checked_no_service_required = $vfm->emergency_roadside_kit_checked_no_service_required;
            $this->emergency_roadside_kit_checked_service_completed = $vfm->emergency_roadside_kit_checked_service_completed;

            // Under the Hood
            $this->engine_oil_checked_no_service_required = $vfm->engine_oil_checked_no_service_required;
            $this->engine_oil_checked_service_completed = $vfm->engine_oil_checked_service_completed;
            $this->coolant_checked_no_service_required = $vfm->coolant_checked_no_service_required;
            $this->coolant_checked_service_completed = $vfm->coolant_checked_service_completed;
            $this->brake_fluid_checked_no_service_required = $vfm->brake_fluid_checked_no_service_required;
            $this->brake_fluid_checked_service_completed = $vfm->brake_fluid_checked_service_completed;
            $this->power_steering_fluid_checked_no_service_required = $vfm->power_steering_fluid_checked_no_service_required;
            $this->power_steering_fluid_checked_service_completed = $vfm->power_steering_fluid_checked_service_completed;
            $this->transmission_fluid_checked_no_service_required = $vfm->transmission_fluid_checked_no_service_required;
            $this->transmission_fluid_checked_service_completed = $vfm->transmission_fluid_checked_service_completed;
            $this->washer_fluid_checked_no_service_required = $vfm->washer_fluid_checked_no_service_required;
            $this->washer_fluid_checked_service_completed = $vfm->washer_fluid_checked_service_completed;
            $this->air_filter_checked_no_service_required = $vfm->air_filter_checked_no_service_required;
            $this->air_filter_checked_service_completed = $vfm->air_filter_checked_service_completed;
            $this->belts_and_hoses_checked_no_service_required = $vfm->belts_and_hoses_checked_no_service_required;
            $this->belts_and_hoses_checked_service_completed = $vfm->belts_and_hoses_checked_service_completed;
            $this->battery_checked_no_service_required = $vfm->battery_checked_no_service_required;
            $this->battery_checked_service_completed = $vfm->battery_checked_service_completed;

            // Drivetrain
            $this->diagnostic_scan_checked_no_service_required = $vfm->diagnostic_scan_checked_no_service_required;
            $this->diagnostic_scan_checked_service_completed = $vfm->diagnostic_scan_checked_service_completed;
            $this->driveshaft_cv_joints_u_joints_checked_no_service_required = $vfm->driveshaft_cv_joints_u_joints_checked_no_service_required;
            $this->driveshaft_cv_joints_u_joints_checked_service_completed = $vfm->driveshaft_cv_joints_u_joints_checked_service_completed;
            $this->exhaust_checked_no_service_required = $vfm->exhaust_checked_no_service_required;
            $this->exhaust_checked_service_completed = $vfm->exhaust_checked_service_completed;
            $this->brakes_checked_no_service_required = $vfm->brakes_checked_no_service_required;
            $this->brakes_checked_service_completed = $vfm->brakes_checked_service_completed;

            // Interior and Exterior
            $this->body_and_paint_checked_no_service_required = $vfm->body_and_paint_checked_no_service_required;
            $this->body_and_paint_checked_service_completed = $vfm->body_and_paint_checked_service_completed;
            $this->lights_checked_no_service_required = $vfm->lights_checked_no_service_required;
            $this->lights_checked_service_completed = $vfm->lights_checked_service_completed;
            $this->ac_systems_checked_no_service_required = $vfm->ac_systems_checked_no_service_required;
            $this->ac_systems_checked_service_completed = $vfm->ac_systems_checked_service_completed;
            $this->windshield_wipers_checked_no_service_required = $vfm->windshield_wipers_checked_no_service_required;
            $this->windshield_wipers_checked_service_completed = $vfm->windshield_wipers_checked_service_completed;
            $this->windshield_checked_no_service_required = $vfm->windshield_checked_no_service_required;
            $this->windshield_checked_service_completed = $vfm->windshield_checked_service_completed;
            $this->window_operation_checked_no_service_required = $vfm->window_operation_checked_no_service_required;
            $this->window_operation_checked_service_completed = $vfm->window_operation_checked_service_completed;
            $this->mirrors_checked_no_service_required = $vfm->mirrors_checked_no_service_required;
            $this->mirrors_checked_service_completed = $vfm->mirrors_checked_service_completed;

            // Suspension
            $this->tires_checked_no_service_required = $vfm->tires_checked_no_service_required;
            $this->tires_checked_service_completed = $vfm->tires_checked_service_completed;
            $this->tire_air_pressure_checked_no_service_required = $vfm->tire_air_pressure_checked_no_service_required;
            $this->tire_air_pressure_checked_service_completed = $vfm->tire_air_pressure_checked_service_completed;
            $this->shocks_struts_checked_no_service_required = $vfm->shocks_struts_checked_no_service_required;
            $this->shocks_struts_checked_service_completed = $vfm->shocks_struts_checked_service_completed;
            $this->ball_joints_and_bushings_checked_no_service_required = $vfm->ball_joints_and_bushings_checked_no_service_required;
            $this->ball_joints_and_bushings_checked_service_completed = $vfm->ball_joints_and_bushings_checked_service_completed;

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
        $vfm->horn_checked_no_service_required = $this->horn_checked_no_service_required;
        $vfm->horn_checked_service_completed = $this->horn_checked_service_completed;
        $vfm->seatbelts_checked_no_service_required = $this->seatbelts_checked_no_service_required;
        $vfm->seatbelts_checked_service_completed = $this->seatbelts_checked_service_completed;
        $vfm->detention_equipment_checked_no_service_required = $this->detention_equipment_checked_no_service_required;
        $vfm->detention_equipment_checked_service_completed = $this->detention_equipment_checked_service_completed;
        $vfm->fire_extinguisher_checked_no_service_required = $this->fire_extinguisher_checked_no_service_required;
        $vfm->fire_extinguisher_checked_service_completed = $this->fire_extinguisher_checked_service_completed;
        $vfm->battery_booster_checked_no_service_required = $this->battery_booster_checked_no_service_required;
        $vfm->battery_booster_checked_service_completed = $this->battery_booster_checked_service_completed;
        $vfm->emergency_roadside_kit_checked_no_service_required = $this->emergency_roadside_kit_checked_no_service_required;
        $vfm->emergency_roadside_kit_checked_service_completed = $this->emergency_roadside_kit_checked_service_completed;

        // Under the Hood
        $vfm->engine_oil_checked_no_service_required = $this->engine_oil_checked_no_service_required;
        $vfm->engine_oil_checked_service_completed = $this->engine_oil_checked_service_completed;
        $vfm->coolant_checked_no_service_required = $this->coolant_checked_no_service_required;
        $vfm->coolant_checked_service_completed = $this->coolant_checked_service_completed;
        $vfm->brake_fluid_checked_no_service_required = $this->brake_fluid_checked_no_service_required;
        $vfm->brake_fluid_checked_service_completed = $this->brake_fluid_checked_service_completed;
        $vfm->power_steering_fluid_checked_no_service_required = $this->power_steering_fluid_checked_no_service_required;
        $vfm->power_steering_fluid_checked_service_completed = $this->power_steering_fluid_checked_service_completed;
        $vfm->transmission_fluid_checked_no_service_required = $this->transmission_fluid_checked_no_service_required;
        $vfm->transmission_fluid_checked_service_completed = $this->transmission_fluid_checked_service_completed;
        $vfm->washer_fluid_checked_no_service_required = $this->washer_fluid_checked_no_service_required;
        $vfm->washer_fluid_checked_service_completed = $this->washer_fluid_checked_service_completed;
        $vfm->air_filter_checked_no_service_required = $this->air_filter_checked_no_service_required;
        $vfm->air_filter_checked_service_completed = $this->air_filter_checked_service_completed;
        $vfm->belts_and_hoses_checked_no_service_required = $this->belts_and_hoses_checked_no_service_required;
        $vfm->belts_and_hoses_checked_service_completed = $this->belts_and_hoses_checked_service_completed;
        $vfm->battery_checked_no_service_required = $this->battery_checked_no_service_required;
        $vfm->battery_checked_service_completed = $this->battery_checked_service_completed;

        // Drivetrain
        $vfm->diagnostic_scan_checked_no_service_required = $this->diagnostic_scan_checked_no_service_required;
        $vfm->diagnostic_scan_checked_service_completed = $this->diagnostic_scan_checked_service_completed;
        $vfm->driveshaft_cv_joints_u_joints_checked_no_service_required = $this->driveshaft_cv_joints_u_joints_checked_no_service_required;
        $vfm->driveshaft_cv_joints_u_joints_checked_service_completed = $this->driveshaft_cv_joints_u_joints_checked_service_completed;
        $vfm->exhaust_checked_no_service_required = $this->exhaust_checked_no_service_required;
        $vfm->exhaust_checked_service_completed = $this->exhaust_checked_service_completed;
        $vfm->brakes_checked_no_service_required = $this->brakes_checked_no_service_required;
        $vfm->brakes_checked_service_completed = $this->brakes_checked_service_completed;

        // Interior and Exterior
        $vfm->body_and_paint_checked_no_service_required = $this->body_and_paint_checked_no_service_required;
        $vfm->body_and_paint_checked_service_completed = $this->body_and_paint_checked_service_completed;
        $vfm->lights_checked_no_service_required = $this->lights_checked_no_service_required;
        $vfm->lights_checked_service_completed = $this->lights_checked_service_completed;
        $vfm->ac_systems_checked_no_service_required = $this->ac_systems_checked_no_service_required;
        $vfm->ac_systems_checked_service_completed = $this->ac_systems_checked_service_completed;
        $vfm->windshield_wipers_checked_no_service_required = $this->windshield_wipers_checked_no_service_required;
        $vfm->windshield_wipers_checked_service_completed = $this->windshield_wipers_checked_service_completed;
        $vfm->windshield_checked_no_service_required = $this->windshield_checked_no_service_required;
        $vfm->windshield_checked_service_completed = $this->windshield_checked_service_completed;
        $vfm->window_operation_checked_no_service_required = $this->window_operation_checked_no_service_required;
        $vfm->window_operation_checked_service_completed = $this->window_operation_checked_service_completed;
        $vfm->mirrors_checked_no_service_required = $this->mirrors_checked_no_service_required;
        $vfm->mirrors_checked_service_completed = $this->mirrors_checked_service_completed;

        // Suspension
        $vfm->tires_checked_no_service_required = $this->tires_checked_no_service_required;
        $vfm->tires_checked_service_completed = $this->tires_checked_service_completed;
        $vfm->tire_air_pressure_checked_no_service_required = $this->tire_air_pressure_checked_no_service_required;
        $vfm->tire_air_pressure_checked_service_completed = $this->tire_air_pressure_checked_service_completed;
        $vfm->shocks_struts_checked_no_service_required = $this->shocks_struts_checked_no_service_required;
        $vfm->shocks_struts_checked_service_completed = $this->shocks_struts_checked_service_completed;
        $vfm->ball_joints_and_bushings_checked_no_service_required = $this->ball_joints_and_bushings_checked_no_service_required;
        $vfm->ball_joints_and_bushings_checked_service_completed = $this->ball_joints_and_bushings_checked_service_completed;

        $vfm->description_of_service = $this->description_of_service;
        $vfm->is_outside_service_required = $this->is_outside_service_required;
        $vfm->outside_service_required = $this->outside_service_required;
        $vfm->outside_service_po = $this->outside_service_po;

        $vfm->save();

        session()->flash('message', $this->vfmId ? 'VFM updated successfully!' : 'VFM created successfully!');

        return redirect()->route('vfm30.dashboard'); // Redirect to user list
    }

    public function render()
    {
        return view('VFM30.livewire.vfm30-form');
    }
}
