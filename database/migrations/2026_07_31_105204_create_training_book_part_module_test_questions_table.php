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
        Schema::create('training_book_part_module_test_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('test_id')
                ->constrained('training_book_part_module_tests')
                ->cascadeOnDelete();

            $table->enum('type', [
                'multiple_choice',
                'fill_blank',
                'freeform',
            ]);

            $table->text('question');

            $table->unsignedInteger('points')->default(1);
            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('required')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_test_questions');
    }
};
