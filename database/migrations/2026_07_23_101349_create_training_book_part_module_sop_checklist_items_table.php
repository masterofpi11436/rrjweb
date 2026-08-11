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
        Schema::create('training_book_part_module_sop_checklist_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sop_checklist_id');

            $table->foreign('sop_checklist_id', 'sop_checklist_items_fk')
                ->references('id')
                ->on('training_book_part_module_sop_checklists')
                ->cascadeOnDelete();

            $table->string('item');

            $table->text('description')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_sop_checklist_items');
    }
};
