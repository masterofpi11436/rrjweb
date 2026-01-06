@extends('layouts.tablet')

@section('title', 'Create New Inmate Entry')

@section('heading', 'Create New Inmate Entry')

@section('content')

<a href="{{ route('tablet.dashboard') }}">Back</a>

@livewire('Tablet.tablet-form')

@endsection
