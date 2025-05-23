@extends('layouts.jurisdiction')

@section('title', 'Create Time Log')

@section('heading', 'Create Time Log')

@section('content')

<a href="{{ route('jurisdiction.time-logs') }}">Back</a>

@livewire('jurisdiction.jurisdiction-time-log-form', ['id' => $id])

@endsection
