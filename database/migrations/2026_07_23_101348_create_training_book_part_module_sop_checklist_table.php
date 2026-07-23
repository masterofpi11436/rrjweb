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
            $table->string('number');
            $table->string('title');
            $table->date('completion_date');
            $table->unsignedInteger('sort_order');
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
