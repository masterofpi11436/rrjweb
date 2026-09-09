@extends('layouts.Training.admin')

@section('title', 'Book Dashboard')

@section('heading', 'Book Dashboard')

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
                   rounded-md border border-slate-500
                   hover:bg-slate-600 hover:border-slate-400
                   transition inline-block text-center">

                Back To Dashboard
            </a>
        </div>
        <div>
            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-slate-500
                   hover:bg-slate-600 hover:border-slate-400
                   transition inline-block text-center">
                Manage Training Modules
            </a>
        </div>
    </div>

    @livewire('Training.Book.BookSearch')


@endsection
