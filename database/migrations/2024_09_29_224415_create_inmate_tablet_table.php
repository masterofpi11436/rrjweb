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
        Schema::create('inmate_tablet', function (Blueprint $table) {
            $table->id();
            $table->integer('inmate_number');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->date('date_tablet_found')->nullable();
            $table->boolean('101_incident_report_filed')->default(false);
            $table->boolean('is_filed_by_inmate_accounts')->default(false);
            $table->boolean('is_charged_by_inmate_accounts')->default(false);
            $table->boolean('is_payed')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmate_tablet');
    }
};
