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
        Schema::create('programs_tc_weekly_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('staff_name');
            $table->string('area')->nullable(); // HU 1/5, HU 2, HU 4D, etc.
            $table->string('role'); // caseworker or counselor

            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');

            /*
            |--------------------------------------------------------------------------
            | Caseworker Metrics
            |--------------------------------------------------------------------------
            */
            $caseworkerMetrics = [
                'notary',
                'ss_card_requests',
                'home_assistance',
                'ss_approved_mailed',
                'transportation_assistance',
                'received_ss',
                'direct_1_on_1',
                'email_contacts',
                'after_release',
                'classification_meetings',
                'snap_application_requests',
                'snap_application_received',
                'home_plans',
                'initial_reentry_assessments',
                'classes_groups',
                'medicaid_application_phone_interviews',
                'attorney_calls',
                'approved_calls',
                'community_referrals',
                'mental_health_requests',
                'interstate_compact_transfer',
            ];

            foreach ($caseworkerMetrics as $metric) {
                $table->unsignedInteger($metric . '_week_1')->default(0);
                $table->unsignedInteger($metric . '_week_2')->default(0);
                $table->unsignedInteger($metric . '_week_3')->default(0);
                $table->unsignedInteger($metric . '_week_4')->default(0);
                $table->text($metric . '_notes')->nullable();
            }

            /*
            |--------------------------------------------------------------------------
            | Counselor Metrics
            |--------------------------------------------------------------------------
            */
            $counselorMetrics = [
                'tc_program_total',
                'cog_program_total',
                'veterans_total',
                'total_males',
                'total_females',
                'males',
                'females',
                'removed_discipline',
                'bonded',
                'removed_released',
                'moved_in',
                'waiting_placement',
                'pending_recruitment',
                'gca_submissions_tc',
                'gca_submissions_cog',
                'va_rep_visits',
            ];

            foreach ($counselorMetrics as $metric) {
                $table->unsignedInteger($metric . '_week_1')->default(0);
                $table->unsignedInteger($metric . '_week_2')->default(0);
                $table->unsignedInteger($metric . '_week_3')->default(0);
                $table->unsignedInteger($metric . '_week_4')->default(0);
                $table->text($metric . '_notes')->nullable();
            }

            /*
            |--------------------------------------------------------------------------
            | Homeless Update Section
            |--------------------------------------------------------------------------
            */
            $table->string('homeless_name')->nullable();
            $table->date('homeless_release_date')->nullable();
            $table->string('homeless_assigned_staff')->nullable();
            $table->string('homeless_housing_status')->nullable();
            $table->string('homeless_referral_status')->nullable();
            $table->date('homeless_follow_up_date')->nullable();
            $table->text('homeless_notes')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Announcements / Updates
            |--------------------------------------------------------------------------
            */
            $table->longText('announcements')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs_tc_weekly_reports');
    }
};
