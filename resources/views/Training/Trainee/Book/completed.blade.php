@extends('layouts.Training.trainee')

@section('title', 'Completed Training')

@section('heading', 'Completed Training')

@section('content')

    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="flex items-center justify-between gap-4">

            <div>

                <h2 class="text-xl font-semibold text-white">
                    Completed Training
                </h2>

                <p class="mt-1 text-sm text-gray-400">
                    Review training assignments you have completed.
                </p>

            </div>


            <a href="{{ route('training.trainee.dashboard') }}"
                class="rounded-lg border border-gray-700 bg-gray-800
                       px-4 py-2 text-sm font-medium text-gray-200
                       transition
                       hover:border-blue-500 hover:bg-gray-700">

                Back to Dashboard

            </a>

        </div>


        {{-- Completed Assignments --}}
        <div class="space-y-4">

            @forelse ($assignments as $assignment)
                <a href="{{ route('training.trainee.book.show', ['assignment' => $assignment->id]) }}"
                    class="group block rounded-xl border border-gray-800
                           bg-gray-900 p-6 transition
                           hover:border-green-500 hover:bg-gray-800">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        {{-- Book Information --}}
                        <div>

                            <div class="flex items-center gap-3">

                                <h3 class="text-lg font-semibold text-white">
                                    {{ $assignment->book->title }}
                                </h3>

                                <span
                                    class="rounded-full bg-green-500/10
                                             px-3 py-1 text-xs font-medium
                                             text-green-400">

                                    Completed

                                </span>

                            </div>


                            <p class="mt-2 text-sm text-gray-400">

                                Assigned:

                                {{ $assignment->assigned_at?->format('F j, Y') }}

                            </p>


                            @if ($assignment->completed_at)
                                <p class="mt-1 text-sm text-gray-400">

                                    Completed:

                                    {{ $assignment->completed_at->format('F j, Y') }}

                                </p>
                            @endif

                        </div>


                        {{-- Review --}}
                        <div class="flex items-center gap-3">

                            <span class="text-sm font-medium text-green-400">
                                Review Training
                            </span>

                            <span
                                class="text-2xl text-gray-500
                                         transition group-hover:text-green-400">
                                &rarr;
                            </span>

                        </div>

                    </div>

                </a>

            @empty

                <div class="rounded-xl border border-gray-800 bg-gray-900 p-8 text-center">

                    <h3 class="font-medium text-gray-200">
                        No Completed Training
                    </h3>

                    <p class="mt-2 text-sm text-gray-400">
                        You have not completed any training assignments yet.
                    </p>

                </div>
            @endforelse

        </div>

    </div>

@endsection
