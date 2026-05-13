@extends('layouts.policy-builder')

@section('title', 'Policy Builder')

@section('heading', 'Policy Builder')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <a 
            href="{{ route('policy.dashboard') }}"
            class="text-sm font-medium text-gray-600 hover:text-gray-900"
        >
            ← Back to All Policies
        </a>

        <a 
            href="{{ route('policy.builder.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
        >
            Create A Policy
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">
            Policy Builder
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            List of policies that were created here in this app.
        </p>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        @livewire('policy.builder.policy-builder-search')
    </div>

</div>
@endsection