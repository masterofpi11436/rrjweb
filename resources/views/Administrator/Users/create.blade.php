@extends('layouts.administrator')

@section('title', 'Create New User')

@section('heading', 'Create New User')

@section('content')

<a href="{{ route('admin.index') }}">Back</a>

@livewire('administrator.user-form')

@endsection
