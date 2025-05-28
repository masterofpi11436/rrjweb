@extends('layouts.jurisdiction')

@section('title', 'Create Time Log')

@section('heading', 'Create Time Log')

@section('content')

<div style="overflow: hidden; margin-bottom: 20px;">
    <a href="{{ route('jurisdiction.time-logs') }}"
       style="float: left; display: inline-block; padding: 8px 16px; background-color: #ccc; color: #000; text-decoration: none; border-radius: 4px;">
       Back
    </a>

    <a href="{{ route('jurisdiction.create') }}"
       style="float: right; display: inline-block; padding: 8px 16px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 4px;">
       Create Jurisction
    </a>
</div>

@livewire('jurisdiction.jurisdiction-time-log-form')

@endsection
