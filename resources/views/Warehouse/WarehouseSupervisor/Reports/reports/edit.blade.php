@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Edit Recipient')

@section('heading', 'Edit Recipient')

@section('content')

@livewire('Warehouse.Reports.MonthlyRecipientForm', ['id' => $recipient->id])

@endsection
