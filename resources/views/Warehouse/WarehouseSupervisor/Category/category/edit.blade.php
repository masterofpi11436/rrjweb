@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Edit Section Name')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.section.section-form', ['id' => $section->id])

@endsection
