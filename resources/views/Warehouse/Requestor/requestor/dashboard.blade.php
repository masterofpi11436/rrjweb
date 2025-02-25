@extends('layouts.Warehouse.requestor')

@section('title', 'Warehouse Store Requestor')

@section('heading', 'Warehouse Store')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.requestor.requestor-items')

@endsection
