<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h2 class="text-2xl font-bold text-white">
                Training Book Assignments
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                Manage assigned training books and monitor user progress.
            </p>
        </div>

        <div>
            <a href="{{ route('training.admin.assignments.create') }}"
                class="inline-flex items-center rounded-md border border-white bg-green-600 px-4 py-2 text-white transition hover:bg-green-700">

                Assign Book

            </a>
        </div>
    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-lg border border-gray-700 bg-gray-800 p-5 shadow">

            <div class="text-sm text-gray-400">
                Total Assignments
            </div>

            <div class="mt-2 text-3xl font-bold text-white">
                {{ $assignmentCounts['total'] }}
            </div>

        </div>

        <div class="rounded-lg border border-gray-700 bg-gray-800 p-5 shadow">

            <div class="text-sm text-gray-400">
                Assigned
            </div>

            <div class="mt-2 text-3xl font-bold text-blue-400">
                {{ $assignmentCounts['assigned'] }}
            </div>

        </div>

        <div class="rounded-lg border border-gray-700 bg-gray-800 p-5 shadow">

            <div class="text-sm text-gray-400">
                In Progress
            </div>

            <div class="mt-2 text-3xl font-bold text-yellow-400">
                {{ $assignmentCounts['in_progress'] }}
            </div>

        </div>

        <div class="rounded-lg border border-gray-700 bg-gray-800 p-5 shadow">

            <div class="text-sm text-gray-400">
                Completed
            </div>

            <div class="mt-2 text-3xl font-bold text-green-400">
                {{ $assignmentCounts['completed'] }}
            </div>

        </div>
    </div>

    {{-- Search --}}
    <div class="rounded-lg border border-gray-700 bg-gray-800 p-4">

        <div class="flex flex-col gap-4 md:flex-row md:items-end">

            <div class="flex-1">

                <label for="search" class="mb-2 block text-sm font-medium text-gray-300">

                    Search

                </label>

                <input id="search" type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Search user, email, or book..."
                    class="w-full rounded-lg border border-gray-600 bg-gray-900 px-4 py-2.5 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">

            </div>


            <div class="w-full md:w-56">

                <label for="status" class="mb-2 block text-sm font-medium text-gray-300">

                    Status

                </label>

                <select id="status" wire:model.live="status"
                    class="w-full rounded-lg border border-gray-600 bg-gray-900 px-4 py-2.5 text-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">

                    <option value="">
                        All Statuses
                    </option>

                    <option value="assigned">
                        Assigned
                    </option>

                    <option value="in_progress">
                        In Progress
                    </option>

                    <option value="completed">
                        Completed
                    </option>

                </select>

            </div>


            <button type="button" wire:click="clearFilters"
                class="rounded-lg border border-gray-600 bg-gray-700 px-5 py-2.5 text-white transition hover:bg-gray-600">

                Clear Filters

            </button>

        </div>

    </div>

    {{-- Assignment Table --}}
    <div class="overflow-hidden rounded-lg border border-gray-700 bg-gray-800 shadow">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-700">

                <thead class="bg-gray-900">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">
                            User
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">
                            Role
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">
                            Training Book
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">
                            Assigned
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">
                            Progress
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">
                            Status
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-300">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-700">

                    @forelse ($users as $user)

                        @if ($user->trainingBookAssignments->isNotEmpty())
                            @foreach ($user->trainingBookAssignments as $assignment)
                                @php

                                    $totalModules = $assignment->modules->count();

                                    $completedModules = $assignment->modules->where('status', 'completed')->count();

                                    $progress =
                                        $totalModules > 0 ? round(($completedModules / $totalModules) * 100) : 0;
                                @endphp

                                <tr wire:key="assignment-{{ $assignment->id }}" class="transition hover:bg-gray-700/50">

                                    {{-- User --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="font-medium text-white">
                                            {{ $user->first_name }}
                                            {{ $user->last_name }}
                                        </div>

                                        <div class="text-sm text-gray-400">
                                            {{ $user->email }}
                                        </div>

                                    </td>

                                    {{-- Role --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <span class="rounded-md bg-gray-700 px-2.5 py-1 text-sm text-gray-200">

                                            {{ $user->training_role?->label() ?? 'N/A' }}

                                        </span>

                                    </td>

                                    {{-- Book --}}
                                    <td class="px-6 py-4">

                                        <div class="font-medium text-white">
                                            {{ $assignment->book?->title ?? 'Book Not Found' }}
                                        </div>

                                    </td>

                                    {{-- Assigned --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-300">

                                        {{ $assignment->assigned_at ? $assignment->assigned_at->format('m/d/Y') : '—' }}

                                    </td>

                                    {{-- Progress --}}
                                    <td class="min-w-[220px] px-6 py-4">

                                        <div class="mb-1 flex items-center justify-between text-xs">

                                            <span class="text-gray-400">
                                                {{ $completedModules }}
                                                /
                                                {{ $totalModules }}
                                                Modules
                                            </span>

                                            <span class="font-medium text-white">
                                                {{ $progress }}%
                                            </span>

                                        </div>

                                        <div class="h-2.5 w-full rounded-full bg-gray-700">

                                            <div class="h-2.5 rounded-full bg-blue-600"
                                                style="width: {{ $progress }}%">
                                            </div>

                                        </div>

                                    </td>

                                    {{-- Status --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @switch($assignment->status)
                                            @case('completed')
                                                <span
                                                    class="rounded-full bg-green-900/50 px-3 py-1 text-xs font-semibold text-green-300">
                                                    Completed
                                                </span>
                                            @break

                                            @case('in_progress')
                                                <span
                                                    class="rounded-full bg-yellow-900/50 px-3 py-1 text-xs font-semibold text-yellow-300">
                                                    In Progress
                                                </span>
                                            @break

                                            @default
                                                <span
                                                    class="rounded-full bg-blue-900/50 px-3 py-1 text-xs font-semibold text-blue-300">
                                                    Assigned
                                                </span>
                                        @endswitch

                                    </td>

                                    {{-- Actions --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-right">

                                        <div class="flex justify-end gap-2">

                                            <a href=""
                                                class="rounded-md bg-blue-600 px-3 py-2 text-sm text-white transition hover:bg-blue-700">

                                                View

                                            </a>

                                            @if ($assignment->status !== 'completed')
                                                <button type="button"
                                                    wire:click="deleteAssignment({{ $assignment->id }})"
                                                    wire:confirm="Are you sure you want to remove this training book assignment?"
                                                    class="rounded-md bg-red-600 px-3 py-2 text-sm text-white transition hover:bg-red-700">

                                                    Remove

                                                </button>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr wire:key="user-{{ $user->id }}">

                                <td class="px-6 py-4">

                                    <div class="font-medium text-white">
                                        {{ $user->first_name }}
                                        {{ $user->last_name }}
                                    </div>

                                    <div class="text-sm text-gray-400">
                                        {{ $user->email }}
                                    </div>

                                </td>

                                <td class="px-6 py-4">

                                    <span class="rounded-md bg-gray-700 px-2.5 py-1 text-sm text-gray-200">

                                        {{ $user->training_role?->label() ?? 'N/A' }}

                                    </span>

                                </td>

                                <td colspan="4" class="px-6 py-4 text-sm italic text-gray-500">

                                    No training books assigned.

                                </td>

                                <td class="px-6 py-4 text-right">

                                    <a href="{{ route('training.admin.assignments.create', ['user' => $user->id]) }}"
                                        class="rounded-md bg-green-600 px-3 py-2 text-sm text-white transition hover:bg-green-700">
                                        Assign Book
                                    </a>

                                </td>

                            </tr>
                        @endif

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">

                                    No training users found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($users->hasPages())
                <div class="border-t border-gray-700 px-6 py-4">
                    {{ $users->links() }}
                </div>
            @endif

        </div>
    </div>
