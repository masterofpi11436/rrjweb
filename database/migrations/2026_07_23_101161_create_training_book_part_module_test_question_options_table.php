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
        Schema::create('training_book_part_module_test_question_options', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('question_id');

            $table->text('option');

            $table->boolean('is_correct')->default(false);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->foreign('question_id', 'test_options_question_fk')
                ->references('id')
                ->on('training_book_part_module_test_questions')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_test_question_options');
    }
};
