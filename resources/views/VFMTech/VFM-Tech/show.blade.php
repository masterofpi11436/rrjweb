@extends('layouts.vfm')

@section('title', 'VFM Tech')

@section('heading', 'Show Ticket')

@section('content')

<a href="{{ route('vfm-tech.dashboard') }}">Cancel</a>

@livewire('VFM.VFM-tech-show')

@endsection
