<?php

use App\Enums\CameraStatus;
use App\Enums\CameraType;
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
        Schema::create('camera_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('camera_number')->unique();
            $table->string('camera_name')->unique();
            $table->string('encoder_switch_location');
            $table->string('encoder_switch_name');
            $table->string('encoder_port')->nullable();
            $table->string('camera_model')->nullable();
            $table->ipAddress('ip_address');
            $table->string('firmware_version')->nullable();
            $table->json('credentials');
            $table->enum('NVR', ['nvr_1', 'nvr_2', 'nvr_3', 'nvr_4']);
            $table->text('notes')->nullable();
            $table->enum('camera_type', CameraType::values());
            $table->string('location');
            $table->enum('status', CameraStatus::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camera_statuses');
    }
};
