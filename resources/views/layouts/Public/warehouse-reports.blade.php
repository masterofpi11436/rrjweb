<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/delete-confirmation-modal.css">
    <link rel="stylesheet" href="/css/back-to-top.css" id="common-styles-link">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="flex h-screen bg-gray-900 text-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-green-950 text-gray-100 p-5 flex flex-col h-screen fixed overflow-y-auto" style="-ms-overflow-style: none; scrollbar-width: none;">

            <h1 class="text-4xl font-bold mb-5">Navigation</h1>

            <nav>
                <ul>

                    <!-- Reports -->
                    <li class="mb-3 font-bold">
                        <details class="group">
                            <summary class="flex items-center justify-between p-2 rounded hover:bg-green-900 cursor-pointer">
                                <span>Reports</span>
                                <span class="transform transition-transform duration-300 group-open:rotate-90">▶</span>
                            </summary>
                            <ul class="pl-4 mt-2 hidden group-open:block">
                                <li class="mb-2">
                                    <a href="{{ route('public.reports.monthly') }}" class="block p-2 rounded hover:bg-green-900">Monthly</a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="block p-2 rounded hover:bg-green-900">Calendar Year</a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="block p-2 rounded hover:bg-green-900">Fiscal Year</a>
                                </li>
                            </ul>
                        </details>
                    </li>

                    <hr class="my-3 border-green-700" />
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">
            <!-- Header -->
            <header class="bg-gray-800 text-gray-100 p-4 shadow flex justify-between items-center sticky top-0 z-50">
                <h2 class="text-xl font-semibold">@yield('heading')</h2>
            </header>

            <!-- Content Area -->
            <main class="p-6">
                @yield('content')
            </main>

            <a href="#" id="back-to-top" class="back-to-top">⬆️ Back to Top</a>

            <script src="{{ asset('javascript/back-to-top.js') }}"></script>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
