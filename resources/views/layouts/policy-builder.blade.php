<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-gray-950 text-gray-100 antialiased">

    <header class="sticky top-0 z-50 border-b border-gray-800 bg-gray-950/90 shadow-lg shadow-black/30 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4">
            <h1 class="text-xl font-semibold tracking-tight text-white">
                @yield('heading')
            </h1>

            <div class="flex items-center gap-3">
                <form action="{{ route('policy.logout') }}" method="POST">
                    @csrf
                    <button class="rounded-lg border border-red-900/50 bg-red-950/60 px-4 py-2 text-sm font-medium text-red-300 transition hover:border-red-700 hover:bg-red-900/70 hover:text-red-100">
                        Logout
                    </button>
                </form>

                @if(Auth::user()->admin === 1)
                    <form action="{{ route('admin.dashboard') }}">
                        <button class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-blue-950/40 transition hover:bg-blue-500">
                            Admin Dashboard
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </header>

    <a
        href="#"
        id="back-to-top"
        class="fixed bottom-6 right-6 z-50 hidden rounded-full border border-blue-500/40 bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-950/50 transition hover:bg-blue-500"
    >
        ↑ Back to Top
    </a>

    <main class="mx-auto max-w-7xl px-6 py-8">
        @yield('content')
    </main>

    @livewireScripts

    <script src="{{ asset('javascript/theme-switcher.js') }}"></script>
    <script src="{{ asset('javascript/flash-message-expiry.js') }}"></script>
    <script src="{{ asset('javascript/delete-confirmation.js') }}"></script>
    <script src="{{ asset('javascript/back-to-top.js') }}"></script>
</body>
</html>