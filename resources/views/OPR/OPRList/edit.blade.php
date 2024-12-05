@extends('layouts.oprList')

@section('title', 'Edit Name')

@section('heading', 'Edit Name')

@section('content')

<a href="{{ route('oprList.dashboard') }}">Back</a>

@livewire('oprList.oprList-form', ['id' => $oprListId->id])

@endsection
