@extends('layouts.Training.admin')

@section('title', 'Create Paragraph Module')

@section('heading', 'Create Paragraph Module')

@section('content')

    <h1>Create a paragraph</h1>

    <a href="{{ route('training.admin.modules.dashboard') }}"
        class="px-4 py-2
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                   transition inline-block text-center">
        Back
    </a>

    @livewire('Training.Module.ParagraphForm')

@endsection
