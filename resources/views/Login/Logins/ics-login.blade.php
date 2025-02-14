@extends('layouts.login')

@section('title', 'ICS Login')

@section('heading', 'Inmate Tablet Management Login')

@section('content')

<div>
    {{-- ICS forgot --}}
    <form action="{{ route('ics.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
