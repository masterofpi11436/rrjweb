<?php

use App\Enums\CameraStatus;
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
        Schema::create('camera_status_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('camera_id')
                ->constrained('camera_statuses')
                ->cascadeOnDelete();

            $table->enum('old_status', CameraStatus::values());
            $table->enum('new_status', CameraStatus::values());

            $table->text('notes')->nullable();

            $table->foreignId('changed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['camera_id', 'created_at']);
            $table->index('new_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camera_status_histories');
    }
};
