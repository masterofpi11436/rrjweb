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
            $table->longtext('policy_statement');
            $table->longtext('policy_purpose');

            $table->longtext('standards')->nullable();
            $table->longtext('american_correctional_association')->nullable();
            $table->longtext('va_board_of_local_and_regional_jails')->nullable();
            $table->longtext('prison_rape_and_elimination_act')->nullable();
            $table->longtext('ncchc')->nullable();
            $table->longtext('policy_cross_reference')->nullable();
            $table->longtext('forms')->nullable();
            $table->date('policy_effective_date')->nullable();

            $table->json('policy_revision_dates')->nullable();

            $table->binary('policy_owner_signature')->nullable();
            $table->date('policy_owner_date')->nullable();
            $table->binary('policy_reviewer_signature')->nullable();
            $table->date('policy_reviewer_date')->nullable();
            $table->binary('superintendent_approval_signature')->nullable();
            $table->date('superintendent_approval_date')->nullable();

            $table->longtext('table_of_contents')->nullable();
            $table->longtext('references')->nullable();
            $table->longtext('definitions')->nullable();

            // Aproval Logic
            $table->boolean('revised')->default(false);
            $table->boolean('approved')->default(false);
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
