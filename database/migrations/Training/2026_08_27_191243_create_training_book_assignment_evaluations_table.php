<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_book_assignment_evaluations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assignment_module_id')
                ->unique()
                ->constrained('training_book_assignment_modules')
                ->cascadeOnDelete();

            $table->text('strengths')->nullable();

            $table->text('weaknesses')->nullable();

            $table->text('areas_of_improvement')->nullable();

            $table->foreignId('completed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_book_assignment_evaluations');
    }
};