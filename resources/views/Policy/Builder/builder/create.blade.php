@extends('layouts.policy')

@section('title', 'Create Policy')

@section('heading', 'Create Policy')

@section('content')

@section('content')

<a href="{{ route('policy.builder.index') }}">Back to Builder</a>

@livewire('Policy.Builder.policy-builder-form')

@endsection
