@extends('layouts.policy-builder')

@section('title', 'Edit Policy')

@section('heading', 'Edit Policy')

@section('content')

<a href="{{ route('policy.builder.index') }}">Back to Builder</a>

@livewire('policy.builder.policy-builder-form', ['policyBuilderId' => $policyBuilderId ?? null])

@endsection
