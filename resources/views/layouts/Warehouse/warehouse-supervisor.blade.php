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
                    <li class="mb-3"><a href="{{ route('warehouse.warehouse-supervisor.dashboard')}}" class="font-bold block p-2 rounded hover:bg-green-900">Dashboard</a></li>

                    <hr class="my-3 border-green-700" />

                    <!-- Inventory Management Dropdown -->
                    <li class="mb-3 font-bold">
                        <details class="group">
                            <summary class="flex items-center justify-between p-2 rounded hover:bg-green-900 cursor-pointer">
                                <span>Inventory Management</span>
                                <span class="transform transition-transform duration-300 group-open:rotate-90">▶</span>
                            </summary>
                            <ul class="pl-4 mt-2 hidden group-open:block">
                                <li class="mb-2"><a href="{{ route('warehouse.warehouse-supervisor.item.dashboard') }}" class="block p-2 rounded hover:bg-green-900">Manage Items</a></li>
                                <li class="mb-2"><a href="{{ route('warehouse.warehouse-supervisor.category.dashboard') }}" class="block p-2 rounded hover:bg-green-900">Manage Item Categories</a></li>
                                <li class="mb-2"><a href="{{ route('warehouse.warehouse-supervisor.section.dashboard') }}" class="block p-2 rounded hover:bg-green-900">Manage Sections</a></li>
                                <li class="mb-2"><a href="{{ route('warehouse.warehouse-supervisor.inventory.dashboard') }}" class="block p-2 rounded hover:bg-green-900">Inventory Overview</a></li>
                            </ul>
                        </details>
                    </li>

                    <hr class="my-3 border-green-700" />

                    <!-- Reports -->
                    <li class="mb-3 font-bold">
                        <details class="group">
                            <summary class="flex items-center justify-between p-2 rounded hover:bg-green-900 cursor-pointer">
                                <span>Reports</span>
                                <span class="transform transition-transform duration-300 group-open:rotate-90">▶</span>
                            </summary>
                            <ul class="pl-4 mt-2 hidden group-open:block">
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.reports.monthly') }}" class="block p-2 rounded hover:bg-green-900">Monthly</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.reports.calendar-year') }}" class="block p-2 rounded hover:bg-green-900">Calendar Year</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.reports.fiscal-year') }}" class="block p-2 rounded hover:bg-green-900">Fiscal Year</a>
                                </li>
                            </ul>
                        </details>
                    </li>

                    <hr class="my-3 border-green-700" />

                    <!-- History -->
                    <li class="mb-3 font-bold">
                        <details class="group">
                            <summary class="flex items-center justify-between p-2 rounded cursor-pointer">
                                <span class="flex-1 text-left">
                                    <a href="{{ route('warehouse.warehouse-supervisor.history.dashboard') }}"
                                       class="block w-full bg-green-600 hover:bg-green-700 text-white text-center px-3 py-2 rounded">
                                        History
                                    </a>
                                </span>
                                <span class="ml-2 transform transition-transform duration-300 group-open:rotate-90">▶</span>
                            </summary>

                            <ul class="pl-4 mt-2 hidden group-open:block">
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.history.approved') }}" class="block p-2 rounded hover:bg-green-900">Approved</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.history.denied') }}" class="block p-2 rounded hover:bg-green-900">Denied</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.approved-exchange') }}" class="block p-2 rounded hover:bg-green-900">Approved Exchange</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.denied-exchange') }}" class="block p-2 rounded hover:bg-green-900">Denied Exchange</a>
                                </li>
                            </ul>
                        </details>
                    </li>

                    <hr class="my-3 border-green-700" />

                    <!-- Create Orders -->
                    <li class="mb-3 font-bold">
                        <details class="group">
                            <summary class="flex items-center justify-between p-2 rounded hover:bg-green-900 cursor-pointer">
                                <span>Create Orders</span>
                                <span class="transform transition-transform duration-300 group-open:rotate-90">▶</span>
                            </summary>
                            <ul class="pl-4 mt-2 hidden group-open:block">
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.create-order.dashboard') }}" class="block p-2 rounded hover:bg-green-900">Regular Order</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('warehouse.warehouse-supervisor.create-exchange-order.dashboard') }}" class="block p-2 rounded hover:bg-green-900">1 For 1 Exchange</a>
                                </li>
                            </ul>
                        </details>
                    </li>

                    <hr class="my-3 border-green-700" />

                    <!-- User Management -->
                    <li class="mb-3 font-bold"><a href="{{ route('warehouse.warehouse-supervisor.user.dashboard')}}" class="block p-2 rounded hover:bg-green-900">Manage Users</a></li>

                    <hr class="my-3 border-green-700" />

                    <!-- Pending Orders -->
                    <li class="mb-3 font-bold">
                        <details class="group">
                            <summary class="flex items-center justify-between p-2 rounded hover:bg-green-900 cursor-pointer">
                                <span>Pending Orders</span>
                                <span class="transform transition-transform duration-300 group-open:rotate-90">▶</span>
                            </summary>
                            <ul class="pl-4 mt-2 hidden group-open:block">
                                <li class="mb-3 font-bold">
                                    <a href="{{ route('warehouse.warehouse-supervisor.pending.dashboard') }}"
                                    class="flex justify-between p-2 rounded hover:bg-green-900">
                                        <span>Pending Orders</span>
                                        <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">{{ $pendingOrdersCount }}</span>
                                    </a>
                                </li>
                                <li class="mb-3 font-bold">
                                    <a href="{{ route('warehouse.warehouse-supervisor.pending-exchange.dashboard') }}"
                                    class="flex justify-between p-2 rounded hover:bg-green-900">
                                        <span>Pending 1 For 1 Exhchange Orders</span>
                                        <span class="flex items-center justify-center bg-blue-500 text-white min-w-[2rem] h-[1.75rem] rounded text-sm text-center">
                                            {{ $pendingExchangeOrdersCount }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </details>
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
                        <button type="submit" class="p-2 bg-gray-900 text-white border border-red-500 rounded ml-2 hover:bg-gray-800 hover:border-red-600">
                            Logout
                        </button>
                    </form>

                    @if(Auth::user()->admin === 1)
                        <form action="{{ route('admin.dashboard') }}">
                        <button class="p-2 bg-gray-900 text-white border border-red-500 rounded ml-2 hover:bg-gray-800 hover:border-red-600">
                            Admin Dashboard</button>
                    </form>
                    @endif
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6">
                @yield('content')
            </main>

            <a href="#" id="back-to-top" class="back-to-top">⬆️ Back to Top</a>

            <script src="{{ asset('javascript/delete-confirmation.js') }}"></script>
            <script src="{{ asset('javascript/deny-order-confirmation.js') }}"></script>
            <script src="{{ asset('javascript/flash-message-expiry.js') }}"></script>
            <script src="{{ asset('javascript/back-to-top.js') }}"></script>
        </div>
    </div>
</body>
</html>
