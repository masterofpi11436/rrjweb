@extends('layouts.administrator')

@section('title', 'Edit User')

@section('heading', 'Edit User')

@section('content')

    <a href="{{ route('admin.index') }}">Back</a>

    @livewire('administrator.user-form', ['userId' => $userId])

@endsection
