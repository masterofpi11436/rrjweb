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
        Schema::create('training_book_assignment_signoffs', function (Blueprint $table) {
            $table->id();

            $table->morphs('signable');

            $table->foreignId('signoff_requirement_id')
                ->constrained('training_book_part_module_signoff_requirements')
                ->restrictOnDelete();

            $table->foreignId('signed_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('initials', 10);

            $table->timestamp('signed_at');

            $table->timestamps();

            $table->unique(
                ['signable_type', 'signable_id', 'signoff_requirement_id'],
                'assignment_signoff_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_assignment_signoffs');
    }
};
