<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-100 text-gray-900">

    <header class="sticky top-0 z-50 border-b border-gray-200 bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4">
            <h1 class="text-xl font-semibold text-gray-900">
                @yield('heading')
            </h1>

            <div class="flex items-center gap-3">
                <form action="{{ route('policy.logout') }}" method="POST">
                    @csrf
                    <button class="rounded-lg bg-red-50 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-100">
                        Logout
                    </button>
                </form>

                @if(Auth::user()->admin === 1)
                    <form action="{{ route('admin.dashboard') }}">
                        <button class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
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
        class="fixed bottom-6 right-6 hidden rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-lg hover:bg-blue-700"
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
