@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Reports Dashboard')

@section('heading', 'Reports Dashboard')

@section('content')

<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Reports Dashboard</h1>

    <!-- Tabs -->
    <div class="flex space-x-4 border-b border-gray-700 mb-6">
      <button class="py-2 px-4 border-b-2 border-blue-500 text-blue-400">Weekly</button>
      <button class="py-2 px-4 hover:text-blue-400">Monthly</button>
      <button class="py-2 px-4 hover:text-blue-400">Quarterly</button>
      <button class="py-2 px-4 hover:text-blue-400">Yearly</button>
      <button class="py-2 px-4 hover:text-blue-400">Custom Range</button>
    </div>

    <!-- Example Dropdown for Weekly -->
    <div class="mb-4">
      <label for="week" class="block mb-2 text-sm font-medium text-gray-300">Select Week</label>
      <select id="week" class="bg-gray-800 border border-gray-700 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <option>Week 14 (Apr 1 - Apr 7)</option>
        <option>Week 13 (Mar 25 - Mar 31)</option>
        <option>Week 12 (Mar 18 - Mar 24)</option>
      </select>
    </div>

    <!-- Date Range Picker for Custom -->
    <div class="mb-6 hidden" id="custom-range">
      <label class="block mb-2 text-sm font-medium text-gray-300">Select Date Range</label>
      <div class="flex space-x-4">
        <input type="date" class="bg-gray-800 border border-gray-700 text-gray-100 rounded-lg p-2.5 w-full">
        <input type="date" class="bg-gray-800 border border-gray-700 text-gray-100 rounded-lg p-2.5 w-full">
      </div>
    </div>

    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Generate Report</button>
  </div>

@endsection
