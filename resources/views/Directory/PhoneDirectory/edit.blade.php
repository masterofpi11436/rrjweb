@extends('layouts.phone-directory')

@section('title', 'Edit Current Directory Entry')

@section('heading', 'Edit Current Directory Entry')

@section('content')

<a href="{{ route('phone.dashboard') }}">Back</a>

@livewire('directory.phone-directory-form', ['id' => $phoneDirectory->id])

@endsection
