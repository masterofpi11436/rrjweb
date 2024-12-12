@extends('layouts.vfm')

@section('title', 'VFM')

@section('heading', 'Vehicle Fleet Maintenance Tracker')

@section('content')
<!-- Link to navigate to the Create page -->
<a href="{{ route('vfm.create') }}" class="create-link">Create New Maintenance Ticket</a>

@livewire('VFM.vfm-search')

@endsection
