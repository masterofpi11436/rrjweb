@extends('layouts.inmate-tablet')

@section('title', 'Edit Inmate Tablet Entry')

@section('heading', 'Edit Inmate Tablet Entry')

@section('content')

<a href="{{ route('tablet.dashboard') }}">Back</a>

@livewire('tablet.inmate-tablet-form', ['id' => $inmateTablet->id])

@endsection
