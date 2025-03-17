@extends('layouts.Warehouse.requestor')

@section('title', 'Warehouse Store Requestor')

@section('heading', '1 For 1 Exchange Checkout')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.requestor.requestor-exchange-checkout')

@endsection
