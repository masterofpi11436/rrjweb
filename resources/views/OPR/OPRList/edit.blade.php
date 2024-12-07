@extends('layouts.opr-list')

@section('title', 'Edit Name')

@section('heading', 'Edit Name')

@section('content')

<a href="{{ route('oprList.dashboard') }}">Back</a>

@livewire('OPRList.OPRList-form', ['id' => $oprListId->id])

@endsection
