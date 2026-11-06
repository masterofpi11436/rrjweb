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
        Schema::create('training_book_assignment_modules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assignment_id')
                ->constrained('training_book_assignments')
                ->cascadeOnDelete();

            $table->foreignId('book_part_module_id')
                ->constrained('training_book_part_modules')
                ->cascadeOnDelete();

            $table->enum('status', [
                'not_started',
                'in_progress',
                'completed',
            ])->default('not_started');

            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->unique(['assignment_id', 'book_part_module_id'], 'assignment_module_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_assignment_modules');
    }
};
