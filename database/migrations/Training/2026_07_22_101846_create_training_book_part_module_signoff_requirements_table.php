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
        Schema::create('training_book_part_module_signoff_requirements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('book_part_module_id');

            $table->string('signer_role');

            $table->enum('scope', [
                'module',
                'item',
            ])->default('module');

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->foreign(
                'book_part_module_id',
                'signoff_req_module_fk'
            )
                ->references('id')
                ->on('training_book_part_modules')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_signoff_requirements');
    }
};
