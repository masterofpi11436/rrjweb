@extends('layouts.app')

@section('title', 'Create New Directory Entry')

@section('heading', 'Create New Directory Entry')

@section('content')

<a href="{{ route('Directory.PhoneDirectory.index') }}">Back</a>

@livewire('directory.phone-directory-form')

@endsection