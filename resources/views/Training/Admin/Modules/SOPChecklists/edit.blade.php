@extends('layouts.Training.admin')

@section('title', 'Edit SOP Checklist Module')

@section('heading', 'Edit SOP Checklist Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}"
        class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                   transition inline-block text-center">
        Back
    </a>

    @livewire('Training.Module.SOPChecklistForm', ['checklistId' => $checklistId])

@endsection
