@extends('layouts.Warehouse.requestor')

@section('title', 'Warehouse Store Requestor')

@section('heading', 'Pending Requests')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.requestor.requestor-pending')

@endsection
