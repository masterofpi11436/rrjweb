<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Supervisor Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-green-900 text-white p-5 flex flex-col">
            <h1 class="text-2xl font-bold mb-5">Navigation</h1>
            <nav>
                <ul>
                    <li class="mb-3"><a href="{{ route('warehouse.warehouse-supervisor.dashboard')}}" class="block p-2 rounded hover:bg-blue-700">Dashboard</a></li>

                    <!-- Inventory Management Dropdown -->
                    <li class="mb-3">
                        <details class="group">
                            <summary class="block p-2 rounded hover:bg-blue-700 cursor-pointer">Inventory Management</summary>
                            <ul class="pl-4 mt-2 hidden group-open:block">
                                <li class="mb-2"><a href="{{ route('warehouse.warehouse-supervisor.item.dashboard')}}" class="block p-2 rounded hover:bg-blue-600">Manage Items</a></li>
                                <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-600">Manage Sections</a></li>
                                <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-600">Inventory Overview</a></li>
                            </ul>
                        </details>
                    </li>

                    <!-- Orders Management Dropdown -->
                    <li class="mb-3">
                        <details class="group">
                            <summary class="block p-2 rounded hover:bg-blue-700 cursor-pointer">Orders</summary>
                            <ul class="pl-4 mt-2 hidden group-open:block">
                                <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-600">Pending Orders</a></li>
                                <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-600">Approved Orders</a></li>
                                <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-blue-600">Denied Orders</a></li>
                            </ul>
                        </details>
                    </li>

                    <!-- Reports -->
                    <li class="mb-3"><a href="#" class="block p-2 rounded hover:bg-blue-700">Reports</a></li>

                    <!-- User Management -->
                    <li class="mb-3"><a href="{{ route('warehouse.warehouse-supervisor.user.dashboard')}}" class="block p-2 rounded hover:bg-blue-700">Manage Users</a></li>

                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white p-4 shadow flex justify-between items-center">
                <h2 class="text-xl font-semibold">Warehouse Management</h2>
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
        </div>
    </div>
</body>
</html>
