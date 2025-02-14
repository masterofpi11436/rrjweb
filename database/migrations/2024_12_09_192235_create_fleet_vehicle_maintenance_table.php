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
            $table->integer('vehicle_year');
            $table->string('make');
            $table->string('model');
            $table->string('vin');
            $table->boolean('air_filter')->default(false);
            $table->boolean('antifreeze')->default(false);
            $table->boolean('battery')->default(false);
            $table->boolean('battery_booster')->default(false);
            $table->boolean('belts')->default(false);
            $table->boolean('brake_fluid')->default(false);
            $table->boolean('brakes_front')->default(false);
            $table->boolean('brakes_rear')->default(false);
            $table->boolean('detention_equipment')->default(false);
            $table->boolean('diagnostic_scan')->default(false);
            $table->boolean('engine_oil')->default(false);
            $table->boolean('exhaust')->default(false);
            $table->boolean('hoses')->default(false);
            $table->boolean('lights')->default(false);
            $table->boolean('mirrors')->default(false);
            $table->boolean('power_steering_fluid')->default(false);
            $table->boolean('safety_restraints')->default(false);
            $table->boolean('shocks_struts')->default(false);
            $table->boolean('tires')->default(false);
            $table->boolean('transmission_fluid')->default(false);
            $table->boolean('vehicle_jump_starter')->default(false);
            $table->boolean('washer_fluid')->default(false);
            $table->boolean('window_operation')->default(false);
            $table->boolean('windshield')->default(false);
            $table->boolean('wiper_blades')->default(false);
            $table->boolean('fire_extinguisher')->default(false);
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
