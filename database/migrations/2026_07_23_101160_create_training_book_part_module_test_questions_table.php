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

            $table->unsignedBigInteger('test_id');

            $table->enum('type', [
                'multiple_choice',
                'true_false',
                'free_form',
            ]);

            $table->text('question');

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->foreign('test_id', 'test_questions_test_fk')
                ->references('id')
                ->on('training_book_part_module_tests')
                ->cascadeOnDelete();
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
