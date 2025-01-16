<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vfm_30', function (Blueprint $table) {
            $table->id();
            $table->date('date_in');
            $table->date('date_out');
            $table->date('state_inspection');
            $table->string('license_plate');
            $table->integer('mileage');
            $table->integer('vehicle_year');
            $table->string('make');
            $table->string('model');
            $table->string('vin');

            $table->boolean('horn_checked_no_service_required')->default(false);
            $table->boolean('horn_checked_service_completed')->default(false);
            $table->boolean('seatbelts_checked_no_service_required')->default(false);
            $table->boolean('seatbelts_checked_service_completed')->default(false);
            $table->boolean('detention_equipment_checked_no_service_required')->default(false);
            $table->boolean('detention_equipment_checked_service_completed')->default(false);
            $table->boolean('fire_extinguisher_checked_no_service_required')->default(false);
            $table->boolean('fire_extinguisher_checked_service_completed')->default(false);
            $table->boolean('battery_booster_checked_no_service_required')->default(false);
            $table->boolean('battery_booster_checked_service_completed')->default(false);
            $table->boolean('emergency_roadside_kit_checked_no_service_required')->default(false);
            $table->boolean('emergency_roadside_kit_checked_service_completed')->default(false);

            $table->boolean('engine_oil_checked_no_service_required')->default(false);
            $table->boolean('engine_oil_checked_service_completed')->default(false);
            $table->boolean('coolant_checked_no_service_required')->default(false);
            $table->boolean('coolant_checked_service_completed')->default(false);
            $table->boolean('brake_fluid_checked_no_service_required')->default(false);
            $table->boolean('brake_fluid_checked_service_completed')->default(false);
            $table->boolean('power_steering_fluid_checked_no_service_required')->default(false);
            $table->boolean('power_steering_fluid_checked_service_completed')->default(false);
            $table->boolean('transmission_fluid_checked_no_service_required')->default(false);
            $table->boolean('transmission_fluid_checked_service_completed')->default(false);
            $table->boolean('washer_fluid_checked_no_service_required')->default(false);
            $table->boolean('washer_fluid_checked_service_completed')->default(false);
            $table->boolean('air_filter_checked_no_service_required')->default(false);
            $table->boolean('air_filter_checked_service_completed')->default(false);
            $table->boolean('belts_and_hoses_checked_no_service_required')->default(false);
            $table->boolean('belts_and_hoses_checked_service_completed')->default(false);
            $table->boolean('battery_checked_no_service_required')->default(false);
            $table->boolean('battery_checked_service_completed')->default(false);

            $table->boolean('diagnostic_scan_checked_no_service_required')->default(false);
            $table->boolean('diagnostic_scan_checked_service_completed')->default(false);
            $table->boolean('driveshaft_cv_joints_u_joints_checked_no_service_required')->default(false);
            $table->boolean('driveshaft_cv_joints_u_joints_checked_service_completed')->default(false);
            $table->boolean('exhaust_checked_no_service_required')->default(false);
            $table->boolean('exhaust_checked_service_completed')->default(false);
            $table->boolean('brakes_checked_no_service_required')->default(false);
            $table->boolean('brakes_checked_service_completed')->default(false);

            $table->boolean('body_and_paint_checked_no_service_required')->default(false);
            $table->boolean('body_and_paint_checked_service_completed')->default(false);
            $table->boolean('lights_checked_no_service_required')->default(false);
            $table->boolean('lights_checked_service_completed')->default(false);
            $table->boolean('ac_systems_checked_no_service_required')->default(false);
            $table->boolean('ac_systems_checked_service_completed')->default(false);
            $table->boolean('windshield_wipers_checked_no_service_required')->default(false);
            $table->boolean('windshield_wipers_checked_service_completed')->default(false);
            $table->boolean('windshield_checked_no_service_required')->default(false);
            $table->boolean('windshield_checked_service_completed')->default(false);
            $table->boolean('window_operation_checked_no_service_required')->default(false);
            $table->boolean('window_operation_checked_service_completed')->default(false);
            $table->boolean('mirrors_checked_no_service_required')->default(false);
            $table->boolean('mirrors_checked_service_completed')->default(false);

            $table->boolean('tires_checked_no_service_required')->default(false);
            $table->boolean('tires_checked_service_completed')->default(false);
            $table->boolean('tire_air_pressure_checked_no_service_required')->default(false);
            $table->boolean('tire_air_pressure_checked_service_completed')->default(false);
            $table->boolean('shocks_struts_checked_no_service_required')->default(false);
            $table->boolean('shocks_struts_checked_service_completed')->default(false);
            $table->boolean('ball_joints_and_bushings_checked_no_service_required')->default(false);
            $table->boolean('ball_joints_and_bushings_checked_service_completed')->default(false);

            $table->text('description_of_service')->nullable();
            $table->boolean('is_outside_service_required')->default(false);
            $table->string('outside_service_required');
            $table->string('outside_service_po');
            $table->string('maintenance_technician');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vfm');
    }
};
