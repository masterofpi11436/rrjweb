@extends('layouts.login')

@section('title', 'Mailroom Login')

@section('heading', 'Mailroom Login')

@section('content')

<div>
    {{-- Mailroom forgot --}}
    <form action="{{ route('mailroom.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
