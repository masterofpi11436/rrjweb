@extends('layouts.vfm')

@section('title', 'VFM Admin')

@section('heading', 'Add a New Vehicle')

@section('content')

<a href="{{ route('vfm.dashboard') }}">Cancel</a>

@livewire('VFM.VFM-vehicle-form')

@endsection
