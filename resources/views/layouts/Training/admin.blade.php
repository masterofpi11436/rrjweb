<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-950">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-full bg-gray-950 text-gray-200 antialiased">

    {{-- Header --}}
    <header class="border-b border-gray-800 bg-gray-900 shadow-sm">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-8 py-5">

            {{-- Page Heading --}}
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-white">
                    @yield('heading')
                </h1>
            </div>


            {{-- Header Actions --}}
            <div class="flex items-center gap-3">

                {{-- Main Application Admin --}}
                @if (Auth::user()->admin === 1)
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center justify-center
                               rounded-lg border border-gray-600
                               bg-gray-800 px-4 py-2
                               text-sm font-medium text-gray-200
                               transition
                               hover:border-gray-500
                               hover:bg-gray-700
                               hover:text-white">

                        Admin Dashboard

                    </a>
                @endif


                {{-- Logout --}}
                <form action="{{ route('training.logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="inline-flex items-center justify-center
                               rounded-lg border border-red-700
                               bg-red-600 px-4 py-2
                               text-sm font-semibold text-white
                               transition
                               hover:border-red-600
                               hover:bg-red-500">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </header>


    {{-- Main Content --}}
    <main class="mx-auto w-full max-w-7xl px-8 py-8">

        @yield('content')

    </main>


    {{-- Back To Top --}}
    <a href="#" id="back-to-top"
        class="fixed bottom-6 right-6 z-50
               hidden items-center gap-2
               rounded-lg border border-gray-700
               bg-gray-800 px-4 py-2
               text-sm font-medium text-gray-300
               shadow-lg
               transition
               hover:border-gray-600
               hover:bg-gray-700
               hover:text-white">

        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />

        </svg>

        Back to Top

    </a>


    @livewireScripts

    <script src="{{ asset('javascript/back-to-top.js') }}"></script>

</body>

</html>
