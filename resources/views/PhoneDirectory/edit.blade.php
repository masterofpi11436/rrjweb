@extends('layouts.app')

@section('title', 'Edit Current Directory Entry')

@section('heading', 'Edit Current Directory Entry')

@section('content')

<a href="{{ route('PhoneDirectory.index') }}">Back</a>

@livewire('phone-directory-form', ['id' => $phoneDirectory->id])

@endsection
