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
        Schema::create('quicktix_tickets', function (Blueprint $table) {
            $table->id();

            // Person who created ticket
            $table->foreignId('user_id')->constrained('users');

            // Technician who did the work
            $table->foreignId('technician_id')->constrained('users')->onDelete('set null');

            // Location work takes place
            $table->foreignId('area_id')->constrained('quicktix_areas')->onDelete('set null');

            // Who does the work MIU, Maintenance, Vendor, etc
            $table->foreignId('trade_id')->constrained('quicktix_trades')->onDelete('set null');

            // Status
            $table->foreignId('status_id')->constrained('quicktix_statuses')->onDelete('set null');

            // Description entered by user
            $table->text('user_description');

            // Work done by technician
            $table->text('tech_description')->nullable;

            // Date and time ticket concluded
            $table->timestamp('closed_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quicktix_tickets');
    }
};
