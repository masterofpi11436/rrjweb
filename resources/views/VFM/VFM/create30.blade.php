@extends('layouts.vfm')

@section('title', 'VFM Admin')

@section('heading', 'Create an Insepction Ticket')

@section('content')
<!-- Link to navigate back to the dashboard -->
<a href="{{ route('vfm.dashboard') }}">Cancel</a>

@livewire('VFM.VFM30-form')

@endsection
