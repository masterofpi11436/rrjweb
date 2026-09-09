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
        Schema::create('training_book_part_module_paragraph_lists', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('paragraph_id');

            $table->enum('type', [
                'bullet',
                'ordered',
            ]);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->foreign(
                'paragraph_id',
                'paragraph_list_paragraph_fk'
            )
                ->references('id')
                ->on('training_book_part_module_paragraph_contents')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_paragraph_lists');
    }
};
