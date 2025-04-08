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
        Schema::create('legacy_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('legacy_users');
            $table->foreignId('supervisor_id')
                ->constrained('legacy_users');
            $table->foreignId('section_id')
                ->constrained('legacy_sections');
            $table->json('items');
            $table->enum('status', ['pending supervisor approval','pending warehouse approval','approved','denied']);
            $table->dateTime('created_at');
            $table->dateTime('approved_denied_at');
            $table->foreignId('approved_denied_by')
                ->constrained('legacy_users');
            $table->string('note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legacy_orders');
    }
};
