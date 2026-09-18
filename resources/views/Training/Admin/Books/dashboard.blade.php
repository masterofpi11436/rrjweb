@extends('layouts.Training.admin')

@section('title', 'Book Dashboard')

@section('heading', 'Book Dashboard')

@section('content')

    <!-- Flash Message -->
    @if (session()->has('flashMessage'))
        <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 50);
        
        setTimeout(() => {
            show = false;
        }, 2000);" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-5 right-5 z-50 w-full max-w-md
               rounded-lg border border-green-600
               bg-gray-900 px-5 py-4 text-sm text-gray-200 shadow-lg">

            <div class="flex items-center justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-full bg-green-500/10 text-green-400">
                        ✓
                    </div>

                    <div>

                        <p class="font-semibold text-green-400">
                            Success
                        </p>

                        <p class="mt-0.5 text-gray-300">
                            {{ session('flashMessage') }}
                        </p>

                    </div>

                </div>

                <button type="button" @click="show = false"
                    class="!rounded-md !border-0 !bg-transparent
                       !px-2 !py-1 !text-xl !text-gray-400
                       hover:!bg-gray-800 hover:!text-white
                       !transition">
                    &times;
                </button>

            </div>

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
