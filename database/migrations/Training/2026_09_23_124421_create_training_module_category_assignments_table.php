<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'training_module_category_assignments',
            function (Blueprint $table) {
                $table->id();

                $table->foreignId('category_id')
                    ->constrained('training_module_categories')
                    ->cascadeOnDelete();

                $table->string('module_type');

                $table->unsignedBigInteger('module_id');

                $table->timestamps();

                $table->index(
                    ['module_type', 'module_id'],
                    'module_category_module_idx'
                );

                $table->unique(
                    [
                        'category_id',
                        'module_type',
                        'module_id',
                    ],
                    'module_category_unique'
                );
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'training_module_category_assignments'
        );
    }
};
