@extends('layouts.Training.admin')

@section('title', 'Edit Paragraph Module')

@section('heading', 'Edit Paragraph Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('Training.Module.paragraphform', ['paragraphId' => $paragraphId ?? null])

@endsection
