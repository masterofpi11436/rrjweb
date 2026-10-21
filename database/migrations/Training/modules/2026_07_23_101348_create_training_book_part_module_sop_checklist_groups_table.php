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
        Schema::create('training_book_part_module_sop_checklist_groups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sop_checklist_id');

            $table->string('title');
            $table->string('section_number')->nullable();
            $table->text('description')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->foreign(
                'sop_checklist_id',
                'sop_group_checklist_fk'
            )
                ->references('id')
                ->on('training_book_part_module_sop_checklists')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_sop_checklist_groups');
    }
};
