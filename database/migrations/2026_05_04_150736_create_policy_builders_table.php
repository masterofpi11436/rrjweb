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
        Schema::create('policy_builders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('policy_statement');
            $table->string('policy_purpose');
            $table->string('standards');
            $table->string('american_correctional_association');
            $table->string('va_board_of_local_and_regional_jails');
            $table->string('prison_rape_and_elimination_act');
            $table->string('ncchc');
            $table->string('policy_cross_reference');
            $table->string('forms');
            $table->string('policy_effective_date');
            $table->string('policy_review_revision_date');
            $table->string('table_of_contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_builders');
    }
};
