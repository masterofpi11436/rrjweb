@extends('layouts.vfm30')

@section('title', 'VFM 30 Admin')

@section('heading', 'Create an Insepction Ticket')

@section('content')
<!-- Link to navigate back to the dashboard -->
<a href="{{ route('vfm30.dashboard') }}">Cancel</a>

@livewire('VFM30.VFM30-form')

@endsection
