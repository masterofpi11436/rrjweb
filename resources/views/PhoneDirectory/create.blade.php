@extends('layouts.app')

@section('title', 'Create New Directory Entry')

@section('heading', 'Create New Directory Entry')

@section('content')

<a href="{{ route('PhoneDirectory.index') }}">Back</a>

@livewire('phone-directory-form')

@endsection