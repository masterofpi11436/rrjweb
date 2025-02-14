@extends('layouts.vfm-tech')

@section('title', 'VFM Tech')

@section('heading', 'Create an Insepction Ticket')

@section('content')
<!-- Link to navigate back to the dashboard -->
<a href="{{ route('vfm-tech.dashboard') }}">Cancel</a>

@livewire('VFM.VFM-tech-form')

@endsection
