@extends('layouts.mailroom')

@section('title', 'Edit Mailroom Entry')

@section('heading', 'Edit Mailroom Entry')

@section('content')

<a href="{{ route('mailroom.dashboard') }}">Back</a>

@livewire('mailroom.mailroom-form', ['id' => $mailroom->id])

@endsection
