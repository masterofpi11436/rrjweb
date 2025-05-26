@extends('layouts.jurisdiction')

@section('title', 'Create Time Log')

@section('heading', 'Create Time Log')

@section('content')

<a href="{{ route('jurisdiction.time-logs') }}">Back</a>
<a href="{{ route('jurisdiction.create') }}">Create Jurisction</a>

@livewire('jurisdiction.jurisdiction-time-log-form')

@endsection
