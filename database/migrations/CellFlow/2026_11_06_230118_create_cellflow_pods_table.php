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
        Schema::create('cellflow_pods', function (Blueprint $table) {
            $table->id();

            $table->foreignId('housing_unit_id')
                ->constrained('cellflow_housing_units')
                ->restrictOnDelete();

            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_enabled')->default(true);

            $table->unique(['housing_unit_id', 'name']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cellflow_pods');
    }
};
