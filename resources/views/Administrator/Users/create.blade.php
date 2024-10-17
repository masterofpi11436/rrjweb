@extends('layouts.administrator')

@section('title', 'Create New User')

@section('heading', 'Create New User')

@section('content')

<a href="{{ route('admin.dashboard') }}">Back</a>

@livewire('administrator.user-form')

@endsection
