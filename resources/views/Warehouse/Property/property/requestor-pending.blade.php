@extends('layouts.Warehouse.property')

@section('title', 'Warehouse Store Property')

@section('heading', 'Requests Pending Your Approval')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.property.property-requestor-pending')

@endsection
