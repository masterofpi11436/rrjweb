@extends('layouts.Training.admin')

@section('title', 'Create SOP Checklists Module')

@section('heading', 'Create SOP Checklists Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('Training.Module.SOPChecklistForm')

@endsection
