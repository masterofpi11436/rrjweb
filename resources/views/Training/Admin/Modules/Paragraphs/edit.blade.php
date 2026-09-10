@extends('layouts.Training.admin')

@section('title', 'Edit Paragraph Module')

@section('heading', 'Edit Paragraph Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}"
        class="px-4 py-2
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                   transition inline-block text-center">
        Back
    </a>

    @livewire('Training.Module.ParagraphForm', ['paragraphId' => $paragraphId ?? null])

@endsection
