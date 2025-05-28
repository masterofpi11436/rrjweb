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
        Schema::create('jurisdiction_time_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurisdiction_id')
                ->nullable()
                ->constrained('jurisdictions')
                ->onDelete('set null');
            $table->date('date_of_visit');
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->time('booking_start')->nullable();
            $table->time('booking_end')->nullable();
            $table->time('magistrate_start')->nullable();
            $table->time('magistrate_end')->nullable();
            $table->time('nurse_start')->nullable();
            $table->time('nurse_end')->nullable();
            $table->time('officer_start')->nullable();
            $table->time('officer_end')->nullable();
            $table->integer('inmate_count')->nullable();
            $table->boolean('did_not_get_committed')->default(false);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurisdiction_time_log');
    }
};
