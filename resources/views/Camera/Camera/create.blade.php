@extends('layouts.phone-directory')

@section('title', 'Create Camera Statuses')

@section('heading', 'Create Camera Statuses')

@section('content')

<a href="{{ route('phone.dashboard') }}">Back</a>

@livewire('directory.phone-directory-form')

@endsection
