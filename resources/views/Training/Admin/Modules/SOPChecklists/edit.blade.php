@extends('layouts.Training.admin')

@section('title', 'Edit SOP Checklist Module')

@section('heading', 'Edit SOP Checklist Module')

@section('content')
    <a href="{{ route('training.admin.modules.dashboard') }}">
        Back
    </a>

    @livewire('Training.Module.SOPChecklistForm', ['checklistId' => $checklistId])
@endsection
