@extends('layouts.vfm')

@section('title', 'VFM Tech')

@section('heading', 'Add a New Vehicle Tech')

@section('content')

<a href="{{ route('vfm-tech.vehicle.dashboard') }}">Cancel</a>

@livewire('VFM.VFM-tech-vehicle-form')

@endsection
