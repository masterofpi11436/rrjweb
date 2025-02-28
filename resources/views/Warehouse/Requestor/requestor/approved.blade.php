@extends('layouts.Warehouse.requestor')

@section('title', 'Warehouse Store Requestor')

@section('heading', 'Approved Requests')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.requestor.requestor-approved')

@endsection
