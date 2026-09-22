<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-950">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | Training</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-full bg-gray-950 text-gray-200">

    {{-- Header --}}
    <header class="border-b border-gray-800 bg-gray-900 shadow-lg">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

            {{-- Left side --}}
            <div>
                <h1 class="text-xl font-semibold text-white sm:text-2xl">
                    @yield('heading')
                </h1>

                <p class="mt-1 text-sm text-gray-400">
                    Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </p>
            </div>

            {{-- Right side --}}
            <div>
                <form action="{{ route('training.logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="rounded-lg border border-gray-700 bg-gray-800
                               px-4 py-2 text-sm font-medium text-gray-200
                               transition
                               hover:border-red-500 hover:bg-red-600 hover:text-white
                               cursor-pointer">

                        Logout

                    </button>
                </form>
            </div>

        </div>

    </header>

    {{-- Main Content --}}
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        @yield('content')

    </main>

    @livewireScripts

</body>

</html>
