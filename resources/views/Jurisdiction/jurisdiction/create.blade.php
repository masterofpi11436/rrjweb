@extends('layouts.jurisdiction')

@section('title', 'Create New Jurisdiction')

@section('heading', 'Create Jurisdiction')

@section('content')

<div style="overflow: hidden; margin-bottom: 20px;">
    <a href="{{ route('jurisdiction.create-time-log') }}"
       style="float: left; display: inline-block; padding: 8px 16px; background-color: #ccc; color: #000; text-decoration: none; border-radius: 4px;">
       Back
    </a>
</div>

@livewire('Jurisdiction.jurisdiction-form')

@endsection
