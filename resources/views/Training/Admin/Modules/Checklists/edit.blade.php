@extends('layouts.Training.admin')

@section('title', 'Edit Checklist Module')

@section('heading', 'Edit Checklist Module')

@section('content')
    <a href="{{ route('training.admin.modules.dashboard') }}">
        Back
    </a>

    @livewire('Training.Module.ChecklistForm', ['checklistId' => $checklistId])
@endsection
