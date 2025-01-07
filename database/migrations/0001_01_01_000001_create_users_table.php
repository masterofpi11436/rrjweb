<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            // Applications and their roles
            $table->boolean('admin')->default(false);
            $table->boolean('phone')->default(false);
            $table->boolean('vfm')->default(false);
            $table->boolean('vfm_tech')->default(false);
            $table->boolean('ics')->default(false);
            $table->boolean('policy')->default(false);
            // Warehouse Specific Roles from the warehouse_roles table
            $table->foreignId('warehouse_role_id')
                ->nullable()
                ->default(DB::table('warehouse_roles')->where('name', 'user')->value('id'))
                ->constrained('warehouse_roles')
                ->onDelete('set null');
            $table->timestamps();
        });

        // Password reset tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
