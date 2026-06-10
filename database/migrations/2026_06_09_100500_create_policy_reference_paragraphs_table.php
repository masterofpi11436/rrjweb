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
        Schema::create('policy_reference_paragraphs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('section_id')->constrained('policy_reference_sections')->cascadeOnDelete();
            $table->string('outside_reference')->nullable();
            $table->longText('paragraph');
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_reference_paragraphs');
    }
};
