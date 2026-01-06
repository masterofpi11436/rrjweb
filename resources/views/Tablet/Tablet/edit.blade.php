@extends('layouts.tablet')

@section('title', 'Update Inmate Entry')

@section('heading', 'Update Inmate Entry')

@section('content')

<a href="{{ route('tablet.dashboard') }}">Back</a>

@livewire('Tablet.Tablet-form', ['id' => $tablet->id])

@endsection
