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

            $table->string('signable_type');
            $table->unsignedBigInteger('signable_id');

            $table->unsignedBigInteger('signoff_requirement_id');
            $table->unsignedBigInteger('signed_by');

            $table->timestamp('signed_at');

            $table->timestamps();

            $table->foreign(
                'signoff_requirement_id',
                'assignment_signoff_req_fk'
            )
                ->references('id')
                ->on('training_book_part_module_signoff_requirements')
                ->cascadeOnDelete();

            $table->foreign(
                'signed_by',
                'assignment_signoff_user_fk'
            )
                ->references('id')
                ->on('users');

            $table->index([
                'signable_type',
                'signable_id',
            ], 'assignment_signable_idx');

            $table->unique([
                'signable_type',
                'signable_id',
                'signoff_requirement_id',
            ], 'assignment_signoff_unique');
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
