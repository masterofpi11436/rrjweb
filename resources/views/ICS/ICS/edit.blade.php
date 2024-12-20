@extends('layouts.ics')

@section('title', 'Update Inmate Entry')

@section('heading', 'Update Inmate Entry')

@section('content')

<a href="{{ route('ics.dashboard') }}">Back</a>

@livewire('ics.ics-form', ['id' => $ics->id])

@endsection
