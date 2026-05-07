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

            $table->string('standards')->nullable();
            $table->string('american_correctional_association')->nullable();
            $table->string('va_board_of_local_and_regional_jails')->nullable();
            $table->string('prison_rape_and_elimination_act')->nullable();
            $table->string('ncchc')->nullable();
            $table->string('policy_cross_reference');
            $table->string('forms')->nullable();
            $table->date('policy_effective_date')->nullable();

            $table->json('policy_revision_dates')->nullable();

            $table->binary('policy_owner_signature')->nullable();
            $table->date('policy_owner_date')->nullable();
            $table->binary('policy_reviewer_signature')->nullable();
            $table->date('policy_reviewer_date')->nullable();
            $table->binary('superintendent_approval_signature')->nullable();
            $table->date('superintendent_approval_date')->nullable();

            $table->string('table_of_contents')->nullable();
            $table->foreignId('policy_id')->contrained()->cascadeOnDelete();
            $table->string('references')->nullable();
            $table->string('definitions')->nullable();
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
