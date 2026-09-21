@extends('layouts.Training.admin')

@section('title', 'User Dashboard')

@section('heading', 'User Dashboard')

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

    <!-- Reset Password Flash Message -->
    @if (session()->has('password-reset'))
        <div id="flash-message"
            class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
            <span>{{ session('password-reset') }}</span>
            <button class="text-white font-bold focus:outline-none"
                onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif


    <a href="{{ route('training.admin.dashboard') }}"
        class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400
                   transition inline-block text-center">
        Back To Dasboard
    </a>

    <!-- Livewire search component -->
    @livewire('Training.User.user-search')

@endsection
