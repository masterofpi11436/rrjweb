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
        Schema::create('training_book_part_module_sop_checklist_policies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_id');

            $table->string('policy_number');
            $table->string('title');

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->foreign(
                'group_id',
                'sop_policy_group_fk'
            )
                ->references('id')
                ->on('training_book_part_module_sop_checklist_groups')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_sop_checklists');
    }
};
