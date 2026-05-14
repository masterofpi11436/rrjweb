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
        Schema::create('policy_chapter_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained('policy_chapters')->cascadeOnDelete();
            $table->string('section_title')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_chapter_sections');
    }
};
