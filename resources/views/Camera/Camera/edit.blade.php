@extends('layouts.phone-directory')

@section('title', 'Edit Camera Statuses')

@section('heading', 'Edit Camera Statuses')

@section('content')

<a href="{{ route('phone.dashboard') }}">Back</a>

@livewire('directory.phone-directory-form', ['id' => $phoneDirectory->id])

@endsection
