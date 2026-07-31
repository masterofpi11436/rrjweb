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
        Schema::create('training_book_part_module_test_question_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('question_id')
                ->constrained('training_book_part_module_test_questions')
                ->cascadeOnDelete();

            $table->text('answer');
            $table->boolean('case_sensitive')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_test_question_answers');
    }
};
