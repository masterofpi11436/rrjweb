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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->foreignId('supervisor_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->foreignId('section_id')
                ->nullable() // Delete
                ->constrained('sections')
                ->onDelete('set null');
            $table->json('items');
            $table->foreignId('status_id')
                ->nullable() // Delete
                ->constrained('statuses')
                ->onDelete('set null');
            $table->foreignId('approved_denied_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->date('approved_denied_at')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
