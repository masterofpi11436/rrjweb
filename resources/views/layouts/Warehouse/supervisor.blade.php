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
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-green-900 text-white p-5 flex flex-col h-screen fixed">
            <h1 class="text-4xl font-bold mb-5">Navigation</h1>
            <nav>
                <ul>
                    <!-- Create Order -->
                    <li class="mb-3 font-bold"><a href="{{ route('warehouse.supervisor.dashboard')}}"
                        class="block p-2 rounded hover:bg-blue-700">Create Order</a></li>

                    <!-- 1 For 1 Exchange Orders -->
                    <li class="mb-3 font-bold"><a href="{{ route('warehouse.supervisor.exchange') }}" class="block p-2 rounded hover:bg-blue-700">1 For 1 Exchange</a></li>

                    <!-- Pending Orders -->
                    <li class="mb-3 font-bold">
                        <a href="{{ route('warehouse.supervisor.pending') }}"
                        class="flex justify-between p-2 rounded hover:bg-blue-700">
                            <span>Pending Orders</span>
                            <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">{{ $pendingOrdersCount }}</span>
                        </a>
                    </li>

                    <!-- Recent Orders -->
                    <li class="mb-3 font-bold"><a href="{{ route('warehouse.supervisor.approved') }}" class="block p-2 rounded hover:bg-blue-700">Recent Orders</a></li>

                    <!-- Approve Staff Orders -->
                    <li class="mb-3 font-bold">
                        <a href="{{ route('warehouse.supervisor.requestor-pending') }}"
                        class="flex justify-between p-2 rounded hover:bg-blue-700">
                            <span>Pending Staff Orders</span>
                            <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">{{ $requestorPendingOrdersCount }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">
            <!-- Header -->
            <header class="bg-white p-4 shadow flex justify-between items-center sticky top-0 z-50">
                <h2 class="text-xl font-semibold">@yield('heading')</h2>
                <div class="flex items-center gap-4">
                    <h2>Welcome: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
                    <form action="{{ route('warehouse.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 bg-red-500 text-white rounded ml-2 transition duration-300 ease-in-out hover:bg-red-600 active:bg-red-700 hover:scale-105 active:scale-95">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6">
                @yield('content')
            </main>

            <a href="#" id="back-to-top" class="back-to-top">⬆️ Back to Top</a>

            <script src="{{ asset('javascript/flash-message-expiry.js') }}"></script>
            <script src="{{ asset('javascript/delete-confirmation.js') }}"></script>
            <script src="{{ asset('javascript/back-to-top.js') }}"></script>
        </div>
    </div>
</body>
</html>
