@extends('layouts.Training.admin')

@section('title', 'Training Administration Dashboard')

@section('heading', 'Training Administration Dashboard')

@section('content')

    @php
        /*
        |--------------------------------------------------------------------------
        | Temporary Dashboard Data
        |--------------------------------------------------------------------------
        |
        | This data can later be moved into a controller or Livewire component.
        |
        */

        $statistics = [
            [
                'label' => 'Active Trainees',
                'value' => 18,
                'description' => 'Personnel currently completing initial training',
                'color' => 'blue',
            ],
            [
                'label' => 'Pending Sign-Offs',
                'value' => 27,
                'description' => 'Training items awaiting supervisor approval',
                'color' => 'yellow',
            ],
            [
                'label' => 'Overdue Assignments',
                'value' => 6,
                'description' => 'Training assignments past their due dates',
                'color' => 'red',
            ],
            [
                'label' => 'Annual Compliance',
                'value' => '84%',
                'description' => 'Personnel current on required annual training',
                'color' => 'green',
            ],
        ];

        $trainees = [
            [
                'name' => 'Jordan Smith',
                'position' => 'Correctional Officer',
                'program' => 'New Officer Training',
                'progress' => 76,
                'current_section' => 'Central Control',
                'status' => 'On Track',
                'status_color' => 'green',
            ],
            [
                'name' => 'Taylor Johnson',
                'position' => 'Correctional Officer',
                'program' => 'New Officer Training',
                'progress' => 52,
                'current_section' => 'Booking and Intake',
                'status' => 'Needs Attention',
                'status_color' => 'yellow',
            ],
            [
                'name' => 'Morgan Davis',
                'position' => 'Sergeant',
                'program' => 'Sergeant Field Training',
                'progress' => 91,
                'current_section' => 'Shift Supervision',
                'status' => 'On Track',
                'status_color' => 'green',
            ],
            [
                'name' => 'Casey Williams',
                'position' => 'Civilian',
                'program' => 'Civilian Orientation',
                'progress' => 28,
                'current_section' => 'Facility Safety',
                'status' => 'Behind',
                'status_color' => 'red',
            ],
            [
                'name' => 'Alex Brown',
                'position' => 'Lieutenant',
                'program' => 'Lieutenant Development',
                'progress' => 64,
                'current_section' => 'Administrative Duties',
                'status' => 'On Track',
                'status_color' => 'green',
            ],
        ];

        $pendingSignOffs = [
            [
                'trainee' => 'Jordan Smith',
                'training_item' => 'Central Control Emergency Procedures',
                'submitted' => 'July 15, 2026',
                'supervisor' => 'Sgt. Anderson',
            ],
            [
                'trainee' => 'Taylor Johnson',
                'training_item' => 'Booking Property Procedures',
                'submitted' => 'July 14, 2026',
                'supervisor' => 'Sgt. Miller',
            ],
            [
                'trainee' => 'Morgan Davis',
                'training_item' => 'Shift Briefing and Assignment',
                'submitted' => 'July 13, 2026',
                'supervisor' => 'Lt. Thompson',
            ],
        ];

        $annualTraining = [
            [
                'title' => 'Use of Force Policy Review',
                'assigned' => 142,
                'completed' => 127,
                'due_date' => 'August 1, 2026',
            ],
            [
                'title' => 'PREA Annual Training',
                'assigned' => 142,
                'completed' => 119,
                'due_date' => 'August 15, 2026',
            ],
            [
                'title' => 'Emergency Response Procedures',
                'assigned' => 142,
                'completed' => 98,
                'due_date' => 'September 1, 2026',
            ],
        ];

        $recentActivity = [
            [
                'user' => 'Jordan Smith',
                'action' => 'completed',
                'item' => 'Central Control Radio Procedures',
                'time' => '25 minutes ago',
            ],
            [
                'user' => 'Sgt. Anderson',
                'action' => 'approved',
                'item' => 'Housing Unit Security Checks',
                'time' => '1 hour ago',
            ],
            [
                'user' => 'Taylor Johnson',
                'action' => 'submitted',
                'item' => 'Booking Property Procedures',
                'time' => '2 hours ago',
            ],
            [
                'user' => 'Training Administrator',
                'action' => 'assigned',
                'item' => 'PREA Annual Training',
                'time' => 'Yesterday',
            ],
        ];
    @endphp

    <main class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="rounded-lg border border-green-500/40 bg-green-500/10 px-4 py-3 text-green-700 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- Dashboard Introduction --}}
        <section>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Training Overview
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Review active training programs, personnel progress, outstanding approvals, and annual compliance.
            </p>
        </section>

        {{-- Summary Statistics --}}
        <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($statistics as $statistic)
                @php
                    $statisticClasses = match ($statistic['color']) {
                        'blue' => [
                            'border' => 'border-blue-500',
                            'background' => 'bg-blue-500/10',
                            'text' => 'text-blue-700 dark:text-blue-300',
                        ],
                        'yellow' => [
                            'border' => 'border-yellow-500',
                            'background' => 'bg-yellow-500/10',
                            'text' => 'text-yellow-700 dark:text-yellow-300',
                        ],
                        'red' => [
                            'border' => 'border-red-500',
                            'background' => 'bg-red-500/10',
                            'text' => 'text-red-700 dark:text-red-300',
                        ],
                        default => [
                            'border' => 'border-green-500',
                            'background' => 'bg-green-500/10',
                            'text' => 'text-green-700 dark:text-green-300',
                        ],
                    };
                @endphp

                <div
                    class="rounded-xl border-l-4 {{ $statisticClasses['border'] }} {{ $statisticClasses['background'] }} p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                        {{ $statistic['label'] }}
                    </p>

                    <p class="mt-2 text-3xl font-bold {{ $statisticClasses['text'] }}">
                        {{ $statistic['value'] }}
                    </p>

                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ $statistic['description'] }}
                    </p>
                </div>
            @endforeach
        </section>

        {{-- Active Trainees --}}
        <section
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div
                class="flex flex-col gap-3 border-b border-gray-200 px-5 py-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        Active Trainees
                    </h2>

                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Current completion status for personnel enrolled in training programs.
                    </p>
                </div>

                <a href="#"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                    View All Trainees
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th
                                class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">
                                Trainee
                            </th>

                            <th
                                class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">
                                Program
                            </th>

                            <th
                                class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">
                                Current Section
                            </th>

                            <th
                                class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">
                                Progress
                            </th>

                            <th
                                class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">
                                Status
                            </th>

                            <th
                                class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($trainees as $trainee)
                            @php
                                $statusClasses = match ($trainee['status_color']) {
                                    'red' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300',
                                    'yellow'
                                        => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300',
                                    default => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300',
                                };

                                $progressColor = match (true) {
                                    $trainee['progress'] < 40 => 'bg-red-500',
                                    $trainee['progress'] < 65 => 'bg-yellow-500',
                                    default => 'bg-green-500',
                                };
                            @endphp

                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/70">
                                <td class="whitespace-nowrap px-5 py-4">
                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ $trainee['name'] }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $trainee['position'] }}
                                    </p>
                                </td>

                                <td class="px-5 py-4 text-sm text-gray-700 dark:text-gray-300">
                                    {{ $trainee['program'] }}
                                </td>

                                <td class="px-5 py-4 text-sm text-gray-700 dark:text-gray-300">
                                    {{ $trainee['current_section'] }}
                                </td>

                                <td class="min-w-52 px-5 py-4">
                                    <div class="mb-1 flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                            {{ $trainee['progress'] }}%
                                        </span>
                                    </div>

                                    <div class="h-2.5 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                                        <div class="{{ $progressColor }} h-2.5 rounded-full"
                                            style="width: {{ $trainee['progress'] }}%">
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    <span
                                        class="{{ $statusClasses }} inline-flex rounded-full px-3 py-1 text-xs font-semibold">
                                        {{ $trainee['status'] }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-right">
                                    <a href="#"
                                        class="text-sm font-semibold text-blue-600 hover:underline dark:text-blue-400">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="grid grid-cols-1 gap-8 xl:grid-cols-2">

            {{-- Pending Sign-Offs --}}
            <section
                class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                Pending Sign-Offs
                            </h2>

                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Submitted training items awaiting approval.
                            </p>
                        </div>

                        <span
                            class="rounded-full bg-yellow-100 px-3 py-1 text-sm font-semibold text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300">
                            {{ count($pendingSignOffs) }} Pending
                        </span>
                    </div>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($pendingSignOffs as $signOff)
                        <div class="p-5">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ $signOff['training_item'] }}
                                    </p>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $signOff['trainee'] }}
                                    </p>

                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-500">
                                        Submitted {{ $signOff['submitted'] }} · Assigned to {{ $signOff['supervisor'] }}
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex shrink-0 items-center justify-center rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-800">
                                    Review
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-700">
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:underline dark:text-blue-400">
                        View all pending sign-offs
                    </a>
                </div>
            </section>

            {{-- Annual Training Compliance --}}
            <section
                class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-700">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        Annual Training Compliance
                    </h2>

                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Completion progress for organization-wide assignments.
                    </p>
                </div>

                <div class="space-y-6 p-5">
                    @foreach ($annualTraining as $training)
                        @php
                            $completionPercentage = round(($training['completed'] / $training['assigned']) * 100);
                        @endphp

                        <div>
                            <div class="mb-2 flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ $training['title'] }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Due {{ $training['due_date'] }}
                                    </p>
                                </div>

                                <span class="shrink-0 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $training['completed'] }} / {{ $training['assigned'] }}
                                </span>
                            </div>

                            <div class="h-2.5 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                                <div class="h-2.5 rounded-full bg-blue-600" style="width: {{ $completionPercentage }}%">
                                </div>
                            </div>

                            <p class="mt-1 text-right text-xs text-gray-500 dark:text-gray-400">
                                {{ $completionPercentage }}% complete
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-700">
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:underline dark:text-blue-400">
                        Manage annual training
                    </a>
                </div>
            </section>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- Attention Required --}}
            <section
                class="rounded-xl border border-red-200 bg-red-50 p-5 shadow-sm dark:border-red-900 dark:bg-red-950/30">
                <h2 class="text-lg font-bold text-red-900 dark:text-red-200">
                    Attention Required
                </h2>

                <div class="mt-4 space-y-4">
                    <div class="rounded-lg bg-white/70 p-4 dark:bg-gray-900/60">
                        <p class="font-semibold text-gray-900 dark:text-white">
                            6 overdue assignments
                        </p>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Personnel have training assignments past their assigned due dates.
                        </p>
                    </div>

                    <div class="rounded-lg bg-white/70 p-4 dark:bg-gray-900/60">
                        <p class="font-semibold text-gray-900 dark:text-white">
                            3 inactive trainees
                        </p>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            No training activity has been recorded in the last seven days.
                        </p>
                    </div>

                    <div class="rounded-lg bg-white/70 p-4 dark:bg-gray-900/60">
                        <p class="font-semibold text-gray-900 dark:text-white">
                            2 programs missing supervisors
                        </p>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Training programs need a supervisor assigned before they can begin.
                        </p>
                    </div>
                </div>

                <a href="#"
                    class="mt-5 inline-flex text-sm font-semibold text-red-700 hover:underline dark:text-red-300">
                    Review all issues
                </a>
            </section>

            {{-- Recent Activity --}}
            <section
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900 lg:col-span-2">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                            Recent Training Activity
                        </h2>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Latest submissions, completions, approvals, and assignments.
                        </p>
                    </div>
                </div>

                <div class="mt-5 space-y-1">
                    @foreach ($recentActivity as $activity)
                        <div class="flex gap-4 rounded-lg px-3 py-3 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <div class="mt-2 h-2.5 w-2.5 shrink-0 rounded-full bg-blue-500"></div>

                            <div class="min-w-0">
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        {{ $activity['user'] }}
                                    </span>

                                    {{ $activity['action'] }}

                                    <span class="font-medium text-gray-900 dark:text-white">
                                        {{ $activity['item'] }}
                                    </span>
                                </p>

                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                                    {{ $activity['time'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="#"
                    class="mt-4 inline-flex text-sm font-semibold text-blue-600 hover:underline dark:text-blue-400">
                    View complete activity history
                </a>
            </section>
        </div>

        {{-- Quick Administrative Actions --}}
        <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div>
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Administrative Actions
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Common training management tasks.
                </p>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <a href="#"
                    class="rounded-lg border border-gray-200 p-4 transition hover:border-blue-500 hover:bg-blue-50 dark:border-gray-700 dark:hover:border-blue-500 dark:hover:bg-blue-950/30">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        Add Personnel
                    </p>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Create a new training account.
                    </p>
                </a>

                <a href="#"
                    class="rounded-lg border border-gray-200 p-4 transition hover:border-blue-500 hover:bg-blue-50 dark:border-gray-700 dark:hover:border-blue-500 dark:hover:bg-blue-950/30">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        Assign Training
                    </p>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Assign a program or annual course.
                    </p>
                </a>

                <a href="#"
                    class="rounded-lg border border-gray-200 p-4 transition hover:border-blue-500 hover:bg-blue-50 dark:border-gray-700 dark:hover:border-blue-500 dark:hover:bg-blue-950/30">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        Build Training Program
                    </p>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Manage sections, tasks, documents, and tests.
                    </p>
                </a>

                <a href="#"
                    class="rounded-lg border border-gray-200 p-4 transition hover:border-blue-500 hover:bg-blue-50 dark:border-gray-700 dark:hover:border-blue-500 dark:hover:bg-blue-950/30">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        View Reports
                    </p>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Review completion and compliance reports.
                    </p>
                </a>
            </div>
        </section>

    </main>

@endsection
