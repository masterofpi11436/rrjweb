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

            $table->morphs('signable', 'tbas_signable_idx');

            $table->unsignedBigInteger('signoff_requirement_id');

            $table->foreign('signoff_requirement_id', 'tbas_requirement_fk')
                ->references('id')
                ->on('training_book_part_module_signoff_requirements')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('signed_by');

            $table->foreign('signed_by', 'tbas_signed_by_fk')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();

            $table->string('initials', 10);

            $table->timestamp('signed_at');

            $table->timestamps();

            $table->unique(
                ['signable_type', 'signable_id', 'signoff_requirement_id'],
                'tbas_signable_requirement_unique'
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
