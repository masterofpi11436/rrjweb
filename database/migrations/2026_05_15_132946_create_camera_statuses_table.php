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
            // Public Informtion
            $table->string('camera_number')->unique();
            $table->string('camera_name');
            $table->enum('camera_type', CameraType::values());
            $table->string('location');
            $table->enum('status', CameraStatus::values())->default(CameraStatus::GOOD->value);

            // Login Required
            $table->string('encoder_switch_location');
            $table->ipAddress('ip_address')->unique();
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
