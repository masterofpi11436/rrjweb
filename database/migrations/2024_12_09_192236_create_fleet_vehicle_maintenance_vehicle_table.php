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
        Schema::create('vfm_vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate');
            $table->integer('vehicle_year');
            $table->string('make');
            $table->string('model');
            $table->string('vin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vfm_vehicle');
    }
};
