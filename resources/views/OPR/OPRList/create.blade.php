@extends('layouts.opr-list')

@section('title', 'Create New Inmate Entry')

@section('heading', 'Create New Inmate Entry')

@section('content')

<a href="{{ route('oprList.dashboard') }}">Back</a>

@livewire('OPRList.OPRList-form')

@endsection
