@extends('layouts.oprList')

@section('title', 'Create New Inmate Entry')

@section('heading', 'Create New Inmate Entry')

@section('content')

<a href="{{ route('oprList.dashboard') }}">Back</a>

@livewire('oprList.oprList-form')

@endsection
