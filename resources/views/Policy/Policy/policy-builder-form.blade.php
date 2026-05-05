@extends('layouts.policy')

@section('title', 'Create Policy')

@section('heading', 'Create Policy')

@section('content')

@section('content')

<a href="{{ route('policy.builder') }}">Back</a>

@livewire('policy.policy-builder-form')

@endsection
