@extends('layouts.policy')

@section('title', 'Create a Policy')

@section('heading', 'Create a Policy')

@section('content')

@section('content')

<a href="{{ route('policy.dashboard') }}">Back</a>

<!-- Link to navigate to the Upload page -->
<a href="{{ route('policy.create') }}" class="create-link">Create Policy</a>

@livewire('policy.policy-builder-search')

@endsection
