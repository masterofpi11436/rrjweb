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
        Schema::create('training_book_part_module_media_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('media_id')
                ->constrained('training_book_part_module_media')
                ->cascadeOnDelete();

            $table->string('title')->nullable();

            $table->enum('type', [
                'image',
                'video',
            ]);

            $table->string('file');

            $table->string('original_file_name')->nullable();

            $table->string('mime_type')->nullable();

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
        Schema::dropIfExists('training_book_part_module_media_files');
    }
};
