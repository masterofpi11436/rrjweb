@extends('layouts.mailroom')

@section('title', 'Create New Mailroom Entry')

@section('heading', 'Create New Mailroom Entry')

@section('content')

<a href="{{ route('mailroom.dashboard') }}">Back</a>

@livewire('mailroom.mailroom-form')

@endsection
