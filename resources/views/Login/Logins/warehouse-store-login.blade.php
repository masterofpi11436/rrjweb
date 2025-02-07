@extends('layouts.login')

@section('title', 'Wareshouse Store Login')

@section('heading', 'Wareshouse Store Login')

@section('content')

<div>
    {{-- Warehouse Store forgot --}}
    <form action="{{ route('warehouse.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
