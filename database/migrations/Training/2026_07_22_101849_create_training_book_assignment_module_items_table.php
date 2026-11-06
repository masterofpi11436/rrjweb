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
        Schema::create('training_book_assignment_module_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assignment_module_id')
                ->constrained('training_book_assignment_modules')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('module_item_id');

            $table->enum('status', [
                'not_started',
                'in_progress',
                'completed',
            ])->default('not_started');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->unique(
                ['assignment_module_id', 'module_item_id'],
                'assignment_module_item_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_assignment_module_items');
    }
};
