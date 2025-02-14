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
        Schema::create('ics', function (Blueprint $table) {
            $table->id();
            $table->integer('inmate_number');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->date('date_found');
            $table->boolean('charged_101');
            $table->boolean('filed_with_inmate_accounts');
            $table->boolean('charged_by_inmate_accounts');
            $table->boolean('payment_status');
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ics');
    }
};
