<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/back-to-top.css" id="common-styles-link">
    <link rel="stylesheet" href="/css/delete-confirmation-modal.css">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="flex h-screen bg-gray-900">
        <!-- Sidebar -->
        <aside class="w-64 bg-green-950 text-white p-5 flex flex-col h-screen fixed">
            <h1 class="text-4xl font-bold mb-5">Navigation</h1>
            <nav>
                <ul>
                    <li class="mb-3 font-bold">
                        <a href="{{ route('warehouse.supervisor.dashboard') }}"
                           class="block p-2 rounded hover:bg-green-900">Create Order</a>
                    </li>

                    <li class="mb-3 font-bold">
                        <a href="{{ route('warehouse.supervisor.exchange') }}"
                           class="block p-2 rounded hover:bg-green-900">1 For 1 Exchange</a>
                    </li>

                    <li class="mb-3 font-bold">
                        <a href="{{ route('warehouse.supervisor.pending') }}"
                           class="flex justify-between p-2 rounded hover:bg-green-900">
                            <span>Pending Orders</span>
                            <span class="bg-blue-600 text-white px-2 py-1 rounded text-sm">{{ $pendingOrdersCount }}</span>
                        </a>
                    </li>

                    <li class="mb-3 font-bold">
                        <a href="{{ route('warehouse.supervisor.history') }}"
                           class="block p-2 rounded hover:bg-green-900">Recent Orders</a>
                    </li>

                    <li class="mb-3 font-bold">
                        <a href="{{ route('warehouse.supervisor.requestor-pending') }}"
                           class="flex justify-between p-2 rounded hover:bg-green-900">
                            <span>Pending Staff Orders</span>
                            <span class="bg-blue-600 text-white px-2 py-1 rounded text-sm">{{ $requestorPendingOrdersCount }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">
            <!-- Header -->
            <header class="bg-gray-800 text-gray-100 p-4 shadow flex justify-between items-center sticky top-0 z-50">
                <h2 class="text-xl font-semibold">@yield('heading')</h2>
                <div class="flex items-center gap-4">
                    <h2>Welcome: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
                    <form action="{{ route('warehouse.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 bg-red-600 text-white border border-white rounded ml-2 hover:border-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6">
                @yield('content')
            </main>

            <a href="#" id="back-to-top" class="back-to-top">⬆️ Back to Top</a>

            <script src="{{ asset('javascript/delete-confirmation.js') }}"></script>
            <script src="{{ asset('javascript/flash-message-expiry.js') }}"></script>
            <script src="{{ asset('javascript/back-to-top.js') }}"></script>
        </div>
    </div>
    </div>
</body>
</html>
