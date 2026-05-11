@extends('layouts.policy')

@section('title', 'Policy Builder')

@section('heading', 'Policy Builder')

@section('content')

<a href="{{ route('policy.dashboard') }}">Back to All Policies</a>

<a href="{{ route('policy.builder.create') }}" class="create-link">Create A Policy</a>

@livewire('policy.builder.policy-builder-search')

List of polices that were created here in this app

@endsection
