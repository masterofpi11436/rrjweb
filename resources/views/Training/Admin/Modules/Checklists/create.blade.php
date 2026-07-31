@extends('layouts.Training.admin')

@section('title', 'Create Checklists Module')

@section('heading', 'Create Checklists Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('Training.Module.ChecklistForm')

@endsection
