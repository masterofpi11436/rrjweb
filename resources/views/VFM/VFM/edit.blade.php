@extends('layouts.vfm')

@section('title', 'VFM Admin')

@section('heading', 'Edit an Insepction Ticket')

@section('content')
<!-- Link to navigate back to the dashboard -->
<a href="{{ route('vfm.dashboard') }}">Cancel</a>

@livewire('VFM.VFM-form', ['id' => $vfm->id])

@endsection
