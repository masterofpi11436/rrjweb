<?php

namespace App\Models\VFM30;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VFM30 extends Model
{
    use HasFactory;

    public $table = "vfm_30";

    protected $fillable = [
        'date_in', 'date_out', 'state_inspection', 'license_plate', 'mileage',
        'vehicle_year', 'make', 'model', 'vin', 'description_of_service',
        'is_outside_service_required', 'outside_service_required', 'outside_service_po',
        'horn_checked_no_service_required', 'horn_checked_service_completed',
        'seatbelts_checked_no_service_required', 'seatbelts_checked_service_completed',
        'detention_equipment_checked_no_service_required', 'detention_equipment_checked_service_completed',
        'fire_extinguisher_checked_no_service_required', 'fire_extinguisher_checked_service_completed',
        'battery_booster_checked_no_service_required', 'battery_booster_checked_service_completed',
        'emergency_roadside_kit_checked_no_service_required', 'emergency_roadside_kit_checked_service_completed',
        'engine_oil_checked_no_service_required', 'engine_oil_checked_service_completed',
        'coolant_checked_no_service_required', 'coolant_checked_service_completed',
        'brake_fluid_checked_no_service_required', 'brake_fluid_checked_service_completed',
        'power_steering_fluid_checked_no_service_required', 'power_steering_fluid_checked_service_completed',
        'transmission_fluid_checked_no_service_required', 'transmission_fluid_checked_service_completed',
        'washer_fluid_checked_no_service_required', 'washer_fluid_checked_service_completed',
        'air_filter_checked_no_service_required', 'air_filter_checked_service_completed',
        'belts_and_hoses_checked_no_service_required', 'belts_and_hoses_checked_service_completed',
        'battery_checked_no_service_required', 'battery_checked_service_completed',
        'diagnostic_scan_checked_no_service_required', 'diagnostic_scan_checked_service_completed',
        'driveshaft_cv_joints_u_joints_checked_no_service_required', 'driveshaft_cv_joints_u_joints_checked_service_completed',
        'exhaust_checked_no_service_required', 'exhaust_checked_service_completed',
        'brakes_checked_no_service_required', 'brakes_checked_service_completed',
        'body_and_paint_checked_no_service_required', 'body_and_paint_checked_service_completed',
        'lights_checked_no_service_required', 'lights_checked_service_completed',
        'ac_systems_checked_no_service_required', 'ac_systems_checked_service_completed',
        'windshield_wipers_checked_no_service_required', 'windshield_wipers_checked_service_completed',
        'windshield_checked_no_service_required', 'windshield_checked_service_completed',
        'window_operation_checked_no_service_required', 'window_operation_checked_service_completed',
        'mirrors_checked_no_service_required', 'mirrors_checked_service_completed',
        'tires_checked_no_service_required', 'tires_checked_service_completed',
        'tire_air_pressure_checked_no_service_required', 'tire_air_pressure_checked_service_completed',
        'shocks_struts_checked_no_service_required', 'shocks_struts_checked_service_completed',
        'ball_joints_and_bushings_checked_no_service_required', 'ball_joints_and_bushings_checked_service_completed',
        'maintenance_technician',
    ];
}
