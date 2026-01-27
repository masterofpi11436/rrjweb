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
        Schema::create('tablet', function (Blueprint $table) {
            $table->id();
            $table->integer('inmate_number');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->date('date_found')->nullable();
            $table->boolean('is_reported')->default(false);
            $table->boolean('is_filed')->default(false);
            $table->boolean('is_charged')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablet');
    }
};
