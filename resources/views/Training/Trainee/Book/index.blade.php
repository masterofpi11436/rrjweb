@extends('layouts.Training.trainee')

@section('title', 'Assigned Training')

@section('heading', 'Assigned Training')

@section('content')

    <div class="space-y-6">

        <div>
            <h2 class="text-xl font-semibold text-white">
                Your Training
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                Select a training assignment to continue.
            </p>
        </div>

        <a href="{{ route('training.trainee.dashboard') }}"
            class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-gray-500
                   hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                   transition inline-block text-center">
            Back
        </a>

        <div class="space-y-4">

            @forelse ($assignments as $assignment)
                <a href="{{ route('training.trainee.book.show', ['assignment' => $assignment->id]) }}"
                    class="group block rounded-xl border border-gray-800
                           bg-gray-900 p-6 transition
                           hover:border-blue-500 hover:bg-gray-800">

                    <div class="flex items-center justify-between gap-6">

                        <div>

                            <h3 class="text-lg font-semibold text-white">
                                {{ $assignment->book->title }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-400">
                                Assigned:
                                {{ $assignment->assigned_at?->format('F j, Y') }}
                            </p>

                            @if ($assignment->due_date)
                                <p class="mt-1 text-sm text-gray-400">
                                    Due:
                                    {{ $assignment->due_date->format('F j, Y') }}
                                </p>
                            @endif

                        </div>


                        <div class="flex items-center gap-3">

                            <span class="text-sm text-gray-400">
                                Continue
                            </span>

                            <span
                                class="text-2xl text-gray-500
                                         transition group-hover:text-blue-400">
                                &rarr;
                            </span>

                        </div>

                    </div>

                </a>

            @empty

                <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

                    <p class="text-sm text-gray-400">
                        You do not currently have any assigned training.
                    </p>

                </div>
            @endforelse

        </div>

    </div>

@endsection
