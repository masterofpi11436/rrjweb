<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{
    
    Schema::create('training_book_part_module_checklist_groups', function (Blueprint $table) {
        $table->id();

        $table->foreignId('checklist_id')
            ->constrained('training_book_part_module_checklists')
            ->cascadeOnDelete();

        $table->string('title');

        $table->text('description')->nullable();

        $table->unsignedInteger('sort_order')->default(0);

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_checklist_groups');
    }
};
