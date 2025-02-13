@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Edit Category Name')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.category.category-form', ['id' => $category->id])

@endsection
