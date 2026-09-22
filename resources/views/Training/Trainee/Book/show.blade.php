@extends('layouts.Training.trainee')

@section('title', $book->title)

@section('heading', 'Training')

@section('content')

    <div class="space-y-6">

        <div>
            <a href="{{ route('training.trainee.book.index') }}"
                class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-gray-500
                   hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                   transition inline-block text-center">
                Back
            </a>
        </div>


        {{-- Book Header --}}
        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-2xl font-semibold text-white">
                        {{ $book->title }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-400">
                        Assigned:
                        {{ $assignment->assigned_at?->format('F j, Y') }}
                    </p>

                </div>

                @if ($assignment->due_date)
                    <div class="text-sm text-gray-400">

                        Due:

                        <span class="font-medium text-gray-200">
                            {{ $assignment->due_date->format('F j, Y') }}
                        </span>

                    </div>
                @endif

            </div>

        </div>


        {{-- Training Book Parts --}}
        @forelse ($book->parts as $part)

            <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">

                {{-- Part Header --}}
                <div class="border-b border-gray-800 bg-gray-800 px-6 py-4">

                    <h3 class="text-lg font-semibold text-white">
                        {{ $part->title }}
                    </h3>

                </div>


                {{-- Modules --}}
                <div class="divide-y divide-gray-800">

                    @forelse ($part->modules as $bookModule)
                        <div class="flex items-center justify-between gap-6 px-6 py-5">

                            <div>

                                <h4 class="font-medium text-gray-100">
                                    {{ $bookModule->module->title ?? 'Training Module' }}
                                </h4>

                                @if ($bookModule->module->description ?? null)
                                    <p class="mt-1 text-sm text-gray-400">
                                        {{ $bookModule->module->description }}
                                    </p>
                                @endif

                            </div>

                            <div>
                                <span class="text-sm text-blue-400">
                                    View Training &rarr;
                                </span>
                            </div>

                        </div>

                    @empty

                        <div class="px-6 py-5 text-sm text-gray-400">
                            No training modules are in this section.
                        </div>
                    @endforelse

                </div>

            </div>

        @empty

            <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

                <p class="text-sm text-gray-400">
                    This training book does not contain any sections.
                </p>

            </div>

        @endforelse

    </div>

@endsection
