@extends('layouts.vfm')

@section('title', 'VFM Admin')

@section('heading', 'Edit Vehicle Information')

@section('content')
<!-- Link to navigate back to the dashboard -->
<a href="{{ route('vfm-tech.vehicle.dashboard') }}">Cancel</a>

@livewire('VFM.VFM-tech-vehicle-form', ['id' => $vfm->id])

@endsection
