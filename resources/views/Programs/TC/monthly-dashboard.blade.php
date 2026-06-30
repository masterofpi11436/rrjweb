@extends('layouts.tc')

@section('title', 'RRJ TC')

@section('heading', 'RRJ TC')

@section('content')

    <!-- Flash Message -->
    @if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
            <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
            {{ session('create-edit-delete-message') }}
        </div>
    @endif

    @php

        $caseworkers = [
            ['id' => 1, 'name' => 'Giles', 'area' => 'HU 1/5'],
            ['id' => 2, 'name' => 'Plaskett', 'area' => 'HU 2 (Interim) / 4A MH'],
            ['id' => 3, 'name' => 'Peterkin', 'area' => 'HU 2'],
            ['id' => 4, 'name' => 'Combined', 'area' => 'HU 3'],
            ['id' => 6, 'name' => 'Weeks', 'area' => 'HU 4'],
            ['id' => 7, 'name' => 'Jarmon', 'area' => 'HU 6'],
        ];

        $counselors = [
            ['id' => 101, 'name' => 'Seward', 'area' => 'HU 2A TC/COG Women'],
            ['id' => 102, 'name' => 'Hall', 'area' => 'HU 4D COG / Veterans'],
            ['id' => 102, 'name' => 'Keaton', 'area' => 'HU 4E TC Men'],
        ];

        $caseworkerMetrics = [
            'notary' => 'Notary',
            'ss_card_requests' => 'SS Card Requests',
            'home_assistance' => 'Home Assistance',
            'ss_approved_mailed' => 'SS Approved/Mailed',
            'transportation_assistance' => 'Transportation Assistance',
            'received_ss' => 'Received SS',
            'direct_1_on_1' => 'Direct 1-on-1',
            'email_contacts' => 'Email Contacts',
            'after_release' => 'After Release',
            'classification_meetings' => 'Classification Meetings',
            'snap_application_requests' => 'SNAP Application Requests',
            'snap_application_received' => 'SNAP Application Received',
            'home_plans' => 'Home Plans',
            'initial_reentry_assessments' => 'Initial/Re-entry Assessments',
            'classes_groups' => 'Classes / Groups',
            'medicaid_application_phone_interviews' => 'Medicaid Application / Phone Interviews',
            'attorney_calls' => 'Attorney Calls',
            'approved_calls' => 'Approved Calls',
            'community_referrals' => 'Community Referrals',
            'mental_health_requests' => 'Mental Health Requests',
            'interstate_compact_transfer' => 'Interstate Compact Transfer',
        ];

        $counselorMetrics = [
            'tc_program_total' => 'TC Program Total',
            'cog_program_total' => 'COG Program Total',
            'veterans_total' => 'Veterans',
            'total_males' => 'Total Males',
            'total_females' => 'Total Females',
            'males' => 'Males',
            'females' => 'Females',
            'removed_discipline' => 'Removed - Discipline',
            'bonded' => 'Bonded',
            'removed_released' => 'Removed - Released',
            'moved_in' => 'Moved In',
            'waiting_placement' => 'Waiting Placement',
            'pending_recruitment' => 'Pending Recruitment',
            'gca_submissions_tc' => 'GCA Submissions TC',
            'gca_submissions_cog' => 'GCA Submissions COG',
            'va_rep_visits' => 'VA Rep Visits',
        ];

        $reports = [];

        $canEditCaseworkerFields = true;
        $canEditCounselorFields = true;

    @endphp

    @php
        $loggedInUser = 1;

        $labelCell = 'border border-[#d9e2ec] bg-white px-3 py-3 text-base font-semibold text-black';
        $workerHeader = 'border border-[#d9e2ec] bg-[#eaf3ef] px-3 py-3 text-base font-bold text-black';
        $weekCell = 'border border-[#d9e2ec] bg-[#fffdf6] px-2 py-2 text-center';
        $totalCell = 'border border-[#d9e2ec] bg-[#dcebf5] px-3 py-3 text-center font-bold text-black';
        $inputClass = '
            w-20
            rounded
            border-2
            border-blue-500
            bg-white
            text-black
            text-center
            font-semibold
            px-2
            py-1
            shadow-sm
            focus:ring-2
            focus:ring-blue-500
            focus:border-blue-500
        ';
        $disabledInputClass = '
            w-20
            rounded
            border
            border-gray-300
            bg-gray-200
            text-gray-500
            text-center
            px-2
            py-1
            cursor-not-allowed
            opacity-70
        ';
        $notesInputClass = 'w-full rounded border border-gray-300 bg-white px-2 py-1 text-black';
        $homelessInputClass = 'w-full rounded border border-gray-300 bg-white px-2 py-1 text-black';
    @endphp

    <div class="min-h-screen bg-gray-100 p-6">
        <div class="mx-auto max-w-7xl overflow-hidden rounded-lg bg-white shadow">

            <div class="bg-[#0f2d3f] px-6 py-4 text-center text-2xl font-bold text-white">
                RRJA WEEKLY ACTIVITY TRACKER
            </div>

            <div class="bg-[#1f5e4b] px-6 py-2 text-center font-semibold text-white">
                Caseworker + Counselor Monthly Metrics | Website-Style Administrative Layout
            </div>

            <div class="grid grid-cols-1 gap-4 bg-[#fff7d6] p-4 md:grid-cols-2">
                <div class="flex items-center gap-3">
                    <label class="font-bold text-gray-800">Month:</label>
                    <input type="month" class="rounded border border-gray-300 px-3 py-2">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1100px] border-collapse text-sm">
                    <thead>
                        <tr class="bg-[#0f2d3f] text-white">
                            <th class="border border-[#d9e2ec] px-3 py-2 text-left">Staff Member / Area / Metrics</th>
                            <th class="border border-[#d9e2ec] px-3 py-2 text-center">Week 1</th>
                            <th class="border border-[#d9e2ec] px-3 py-2 text-center">Week 2</th>
                            <th class="border border-[#d9e2ec] px-3 py-2 text-center">Week 3</th>
                            <th class="border border-[#d9e2ec] px-3 py-2 text-center">Week 4</th>
                            <th class="border border-[#d9e2ec] px-3 py-2 text-center">MTD Total</th>
                            <th class="border border-[#d9e2ec] px-3 py-2 text-left">Notes</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="7" class="bg-[#1f5e4b] px-3 py-2 text-lg font-bold text-white">
                                CASEWORKERS
                            </td>
                        </tr>

                        @foreach ($caseworkers as $worker)
                            <tr>
                                <td colspan="7"
                                    class="border border-[#d9e2ec] bg-[#eaf3ef] px-3 py-2 text-base font-bold text-gray-800">
                                    {{ $worker['name'] }} — {{ $worker['area'] }}
                                </td>
                            </tr>

                            @foreach ($caseworkerMetrics as $metric => $label)
                                <tr>
                                    <td class="{{ $labelCell }}">
                                        {{ $label }}
                                    </td>

                                    @for ($week = 1; $week <= 4; $week++)
                                        <td class="{{ $weekCell }}">
                                            @if ($loggedInUser == $worker['id'])
                                                <input type="number" class="week-input">
                                            @else
                                                <input type="number" class="{{ $disabledInputClass }}" disabled>
                                            @endif
                                        </td>
                                    @endfor

                                    <input type="text" class="row-total" readonly>

                                    <td class="border border-[#d9e2ec] bg-white px-2 py-1">
                                        <input type="text" id="total" @disabled(!$canEditCaseworkerFields)>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach

                        {{-- ========================================================= --}}
                        {{-- HOMELESS UPDATES --}}
                        {{-- ========================================================= --}}

                        <tr>
                            <td colspan="7" class="bg-[#d4af37] px-3 py-2 text-lg font-bold text-gray-900">
                                HOMELESS UPDATES
                            </td>
                        </tr>

                        <tr class="bg-[#0f2d3f] text-white">
                            <th class="border border-[#d9e2ec] px-3 py-2 text-left">
                                Name
                            </th>

                            <th class="border border-[#d9e2ec] px-3 py-2">
                                Release Date
                            </th>

                            <th class="border border-[#d9e2ec] px-3 py-2">
                                Assigned Staff
                            </th>

                            <th class="border border-[#d9e2ec] px-3 py-2">
                                Housing Status
                            </th>

                            <th class="border border-[#d9e2ec] px-3 py-2">
                                Referral Status
                            </th>

                            <th class="border border-[#d9e2ec] px-3 py-2">
                                Follow-up
                            </th>

                            <th class="border border-[#d9e2ec] px-3 py-2">
                                Notes
                            </th>
                        </tr>

                        @for ($i = 1; $i <= 3; $i++)
                            <tr>

                                <td class="border border-[#d9e2ec] p-2">
                                    <input type="text" class="{{ $homelessInputClass }}" placeholder="Resident Name">
                                </td>

                                <td class="border border-[#d9e2ec] p-2">
                                    <input type="date" class="{{ $homelessInputClass }}">
                                </td>

                                <td class="border border-[#d9e2ec] p-2">
                                    <select class="{{ $homelessInputClass }}">
                                        <option></option>
                                        <option>Giles</option>
                                        <option>Plaskett</option>
                                        <option>Peterkin</option>
                                        <option>Coleman</option>
                                    </select>
                                </td>

                                <td class="border border-[#d9e2ec] p-2">
                                    <select class="w-full rounded border border-gray-300 px-2 py-1">
                                        <option></option>
                                        <option>Pending</option>
                                        <option>Shelter</option>
                                        <option>Family</option>
                                        <option>Hotel</option>
                                        <option>Permanent Housing</option>
                                    </select>
                                </td>

                                <td class="border border-[#d9e2ec] p-2">
                                    <select class="w-full rounded border border-gray-300 px-2 py-1">
                                        <option></option>
                                        <option>Pending</option>
                                        <option>Submitted</option>
                                        <option>Approved</option>
                                        <option>Denied</option>
                                    </select>
                                </td>

                                <td class="border border-[#d9e2ec] p-2">
                                    <input type="date" class="w-full rounded border border-gray-300 px-2 py-1">
                                </td>

                                <td class="border border-[#d9e2ec] p-2">
                                    <input type="text" class="w-full rounded border border-gray-300 px-2 py-1"
                                        placeholder="Notes">
                                </td>

                            </tr>
                        @endfor

                        <tr>
                            <td colspan="7" class="bg-[#d4af37] px-3 py-2 text-lg font-bold text-gray-900">
                                COUNSELORS
                            </td>
                        </tr>

                        @foreach ($counselors as $counselor)
                            <tr>
                                <td colspan="7"
                                    class="border border-[#d9e2ec] bg-[#eaf3ef] px-3 py-2 text-base font-bold text-gray-800">
                                    {{ $counselor['name'] }} — {{ $counselor['area'] }}
                                </td>
                            </tr>

                            @foreach ($counselorMetrics as $metric => $label)
                                <tr>
                                    <td class="{{ $labelCell }}">
                                        {{ $label }}
                                    </td>

                                    @for ($week = 1; $week <= 4; $week++)
                                        <td class="{{ $weekCell }}">
                                            @if ($loggedInUser == $counselor['id'])
                                                <input type="number" class="week-input">
                                            @else
                                                <input type="number" class="{{ $disabledInputClass }}" disabled>
                                            @endif
                                        </td>
                                    @endfor

                                    <input type="text" id="total" readonly>

                                    <td class="border border-[#d9e2ec] bg-white px-2 py-1">
                                        <input type="text" class="row-total" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-[#d9e2ec] bg-white p-4">
                <label class="mb-2 block font-bold text-gray-800">Announcements / Updates</label>
                <textarea rows="5" class="w-full rounded border border-gray-300 bg-white text-black px-2 py-1"></textarea>
            </div>

            <div class="flex justify-end bg-gray-50 p-4">
                <button type="button" wire:click="save"
                    class="rounded bg-[#0f2d3f] px-6 py-2 font-semibold text-white hover:bg-[#163d54]">
                    Save Report
                </button>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.week-input').forEach(input => {
            input.addEventListener('input', function() {

                const row = this.closest('tr');

                let total = 0;

                row.querySelectorAll('.week-input').forEach(input => {
                    total += Number(input.value) || 0;
                });

                row.querySelector('.row-total').value = total;
            });
        });
    </script>
@endsection
