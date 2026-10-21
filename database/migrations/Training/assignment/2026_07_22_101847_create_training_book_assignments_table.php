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
        Schema::create('training_book_assignments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');

            $table->enum('status', [
                'assigned',
                'in_progress',
                'completed',
            ])->default('assigned');

            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->foreign(
                'user_id',
                'book_assignment_user_fk'
            )
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign(
                'book_id',
                'book_assignment_book_fk'
            )
                ->references('id')
                ->on('training_books')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_assignments');
    }
};
