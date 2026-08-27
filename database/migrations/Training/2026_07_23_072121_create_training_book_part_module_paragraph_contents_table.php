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
        Schema::create('training_book_part_module_paragraph_contents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('paragraph_module_id');

            $table->foreign('paragraph_module_id', 'paragraph_content_module_fk')
                ->references('id')
                ->on('training_book_part_module_paragraphs')
                ->cascadeOnDelete();

            $table->string('heading')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_paragraph_contents');
    }
};
