@extends('layouts.Training.admin')

@section('title', 'Assign Training Book')

@section('heading', 'Assign Training Book')

@section('content')

    <div class="mb-6 flex items-center justify-between">

        <a href="{{ route('training.admin.assignments.dashboard') }}"
            class="inline-block rounded-md border border-white bg-blue-600 px-4 py-2 text-center text-white transition hover:bg-blue-700">

            Back To Assignments

        </a>

    </div>

    @livewire('Training.Assignment.AssignmentForm')

@endsection
