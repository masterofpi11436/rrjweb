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
        Schema::create('training_book_part_module_form_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form_module_id');

            $table->foreign(
                'form_module_id',
                'form_document_module_fk'
            )->references('id')
                ->on('training_book_part_module_forms')
                ->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->string('file_path');
            $table->string('original_file_name');
            $table->unsignedBigInteger('file_size')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_form_documents');
    }
};
