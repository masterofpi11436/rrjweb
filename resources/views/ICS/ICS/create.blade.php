@extends('layouts.ics')

@section('title', 'Create New Inmate Entry')

@section('heading', 'Create New Inmate Entry')

@section('content')

<a href="{{ route('ics.dashboard') }}">Back</a>

@livewire('ICS.ICS-form')

@endsection
