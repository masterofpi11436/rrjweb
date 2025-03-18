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
            $table->string('user_name')->nullable(); // Backup user name if user is deleted
            $table->foreignId('supervisor_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->string('supervisor_name')->nullable(); // Backup supervisor name if user is deleted
            $table->foreignId('section_id')
                ->nullable()
                ->constrained('sections')
                ->onDelete('set null');
            $table->string('section_name')->nullable(); // Backup section name if section is deleted
            $table->json('items');
            $table->enum('status', [
                'Pending Supervisor Approval',
                'Pending Warehouse Approval',
                'Pending Warehouse Exchange Approval',
                'Approved',
                'Exchange Approved',
                'Denied'
            ]);
            $table->foreignId('approved_denied_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->string('approved_denied_by_name')->nullable(); // Backup approver name if user is deleted
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
