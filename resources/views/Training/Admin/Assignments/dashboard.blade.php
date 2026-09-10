@extends('layouts.Training.admin')

@section('title', 'User Assignment Dashboard')

@section('heading', 'User Assignment Dashboard')

@section('content')

    <!-- Flash Message -->
    @if (session()->has('create-edit-delete-message'))
        <div id="flash-message"
            class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
            <span>{{ session('create-edit-delete-message') }}</span>
            <button class="text-white font-bold focus:outline-none"
                onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif


    <div class="flex flex-row justify-between items-center">
        <div>
            <a href="{{ route('training.admin.dashboard') }}"
                class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400
                   transition inline-block text-center">
                Back To Dasboard
            </a>
        </div>
    </div>

    @livewire('Training.Assignment.AssignmentSearch')


@endsection
