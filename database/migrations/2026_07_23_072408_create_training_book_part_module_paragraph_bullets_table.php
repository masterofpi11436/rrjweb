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
        Schema::create('training_book_part_module_paragraph_bullets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paragraph_id')->constrained('training_book_part_module_paragraphs')->cascadeOnDelete();
            $table->string('type'); // Bullet, ordered list
            $table->json('list');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_paragraph_bullets');
    }
};
