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
        Schema::create('policy_definitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('policy_id')->constrained('policy_builders')->cascadeOnDelete();
            $table->string('word');
            $table->text('definition');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_definitions');
    }
};
