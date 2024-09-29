@extends('layouts.app')

@section('title', 'Edit Current Directory Entry')

@section('heading', 'Edit Current Directory Entry')

@section('content')

<a href="{{ route('Directory.PhoneDirectory.index') }}">Back</a>

@livewire('directory.phone-directory-form', ['id' => $phoneDirectory->id])

@endsection
