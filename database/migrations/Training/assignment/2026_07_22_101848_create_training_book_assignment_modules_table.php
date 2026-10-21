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

            $table->unsignedBigInteger('assignment_id');
            $table->unsignedBigInteger('book_part_module_id');

            $table->enum('status', [
                'not_started',
                'in_progress',
                'completed',
            ])->default('not_started');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->foreign(
                'assignment_id',
                'assign_module_assignment_fk'
            )
                ->references('id')
                ->on('training_book_assignments')
                ->cascadeOnDelete();

            $table->foreign(
                'book_part_module_id',
                'assign_module_part_module_fk'
            )
                ->references('id')
                ->on('training_book_part_modules')
                ->cascadeOnDelete();

            $table->unique([
                'assignment_id',
                'book_part_module_id',
            ], 'assignment_module_unique');
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
