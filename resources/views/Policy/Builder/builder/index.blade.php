@extends('layouts.policy-builder')

@section('title', 'Policy Builder')

@section('heading', 'Policy Builder')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <a 
            href="{{ route('policy.dashboard') }}"
            class="text-sm font-medium text-gray-400 transition hover:text-white"
        >
            ← Back to All Policies
        </a>

        <a 
            href="{{ route('policy.builder.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-900/30 transition hover:bg-blue-500"
        >
            Create A Policy
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-3xl font-bold tracking-tight text-white">
            Policy Builder
        </h2>

        <p class="mt-2 text-sm text-gray-400">
            List of policies that were created here in this app.
        </p>
    </div>

    <div class="rounded-2xl border border-gray-800 bg-gray-900/80 p-5 shadow-2xl shadow-black/30 backdrop-blur">
        @livewire('policy.builder.policy-builder-search')
    </div>

</div>
@endsection