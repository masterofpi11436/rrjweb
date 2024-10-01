@extends('layouts.inmate-tablet')

@section('title', 'Create New Inmate Tablet Entry')

@section('heading', 'Create New Inmate Tablet Entry')

@section('content')

<a href="{{ route('tablet.dashboard') }}">Back</a>

@livewire('tablet.inmate-tablet-form')

@endsection