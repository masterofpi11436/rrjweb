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
        Schema::create('vfm', function (Blueprint $table) {
            $table->id();
            $table->date('date_in');
            $table->date('date_out');
            $table->date('state_inspection');
            $table->string('license_plate');
            $table->integer('mileage');
            $table->year('vehicle_year');
            $table->string('make');
            $table->string('model');
            $table->string('vin');
            $table->boolean('air_filter');
            $table->boolean('antifreeze');
            $table->boolean('battery');
            $table->boolean('battery_booster');
            $table->boolean('belts');
            $table->boolean('brake_fluid');
            $table->boolean('brakes_front');
            $table->boolean('brakes_rear');
            $table->boolean('detention_equipment');
            $table->boolean('diagnostic_scan');
            $table->boolean('engine_oil');
            $table->boolean('exhaust');
            $table->boolean('hoses');
            $table->boolean('lights');
            $table->boolean('mirrors');
            $table->boolean('power_steering_fluid');
            $table->boolean('safety_restraints');
            $table->boolean('shocks_struts');
            $table->boolean('tires');
            $table->boolean('transmission_fluid');
            $table->boolean('washer_fluid');
            $table->boolean('window_operation');
            $table->boolean('windshield');
            $table->boolean('wiper_blades');
            $table->boolean('fire_extinguisher');
            $table->text('description_of_service');
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
