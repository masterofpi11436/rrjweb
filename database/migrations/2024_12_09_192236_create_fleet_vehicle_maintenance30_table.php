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

            // Safety Systems
            $table->boolean('horn')->default(false);
            $table->boolean('seatbelts')->default(false);
            $table->boolean('detention_equipment')->default(false);
            $table->boolean('fire_extinguisher')->default(false);
            $table->boolean('battery_booster')->default(false);
            $table->boolean('emergency_roadside_kit')->default(false);

            // Under the Hood
            $table->boolean('engine_oil')->default(false);
            $table->boolean('coolant')->default(false);
            $table->boolean('brake_fluid')->default(false);
            $table->boolean('power_steering_fluid')->default(false);
            $table->boolean('transmission_fluid')->default(false);
            $table->boolean('washer_fluid')->default(false);
            $table->boolean('air_filter')->default(false);
            $table->boolean('belts_and_hoses')->default(false);
            $table->boolean('battery')->default(false);

            // Drivetrain
            $table->boolean('diagnostic_scan')->default(false);
            $table->boolean('driveshaft_cv_joints_u_joints')->default(false);
            $table->boolean('exhaust')->default(false);
            $table->boolean('brakes')->default(false);

            // Interior and Exterior
            $table->boolean('body_and_paint')->default(false);
            $table->boolean('lights')->default(false);
            $table->boolean('a_c_systems')->default(false);
            $table->boolean('windshield_wipers')->default(false);
            $table->boolean('windshield')->default(false);
            $table->boolean('window_operation')->default(false);
            $table->boolean('mirrors')->default(false);

            // Suspension
            $table->boolean('tires')->default(false);
            $table->boolean('tire_air_pressure')->default(false);
            $table->boolean('shock_Struts')->default(false);
            $table->boolean('ball_joints_and_bushings')->default(false);

            $table->text('description_of_service')->nullable();
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
