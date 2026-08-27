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
        Schema::create('training_book_part_module_paragraph_list_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paragraph_list_id');

            $table->foreign(
                'paragraph_list_id',
                'paragraph_list_item_list_fk'
            )->references('id')
                ->on('training_book_part_module_paragraph_lists')
                ->cascadeOnDelete();

            $table->text('content');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_paragraph_list_items');
    }
};
