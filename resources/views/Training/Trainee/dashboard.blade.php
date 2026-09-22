@extends('layouts.Training.trainee')

@section('title', 'Training Dashboard')

@section('heading', 'Training Dashboard')

@section('content')

    <div class="space-y-8">

        {{-- Dashboard Navigation --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">

            {{-- Assigned Training --}}
            <a href="{{ route('training.trainee.book.index') }}"
                class="group rounded-xl border border-gray-800 bg-gray-900 p-6
                    shadow-sm transition
                    hover:border-blue-500 hover:bg-gray-800">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-lg font-semibold text-white">
                            Assigned Training
                        </h2>

                        <p class="mt-2 text-sm text-gray-400">
                            View training books and courses assigned to you.
                        </p>
                    </div>

                    <div class="text-2xl text-gray-500 transition group-hover:text-blue-400">
                        &rarr;
                    </div>

                </div>

            </a>

            {{-- Completed Training --}}
            <a href="{{ route('training.trainee.book.completed') }}"
                class="group rounded-xl border border-gray-800 bg-gray-900 p-6
                       shadow-sm transition
                       hover:border-green-500 hover:bg-gray-800">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-lg font-semibold text-white">
                            Completed Training
                        </h2>

                        <p class="mt-2 text-sm text-gray-400">
                            Review training you have already completed.
                        </p>
                    </div>

                    <div class="text-2xl text-gray-500 transition group-hover:text-green-400">
                        &rarr;
                    </div>

                </div>

            </a>

        </div>


        {{-- Current Training --}}
        <section>

            <div class="mb-4">
                <h2 class="text-lg font-semibold text-white">
                    Current Training
                </h2>

                <p class="mt-1 text-sm text-gray-400">
                    Your active training assignments.
                </p>
            </div>


            <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">

                <div class="p-6">

                    <p class="text-sm text-gray-400">
                        Your assigned training will appear here.
                    </p>

                </div>

            </div>

        </section>

    </div>

@endsection
