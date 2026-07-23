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
        Schema::create('training_book_part_module_sop_checklist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('training_book_part_modules')->cascadeOnDelete();
            $table->string('number');
            $table->string('title');
            $table->string('link'); // Links to pdf web view
            $table->date('completion_date');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_book_part_module_sop_checklist');
    }
};
