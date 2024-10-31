@extends('layouts.login')

@section('title', 'Tablet Login')

@section('heading', 'Tablet Login')

@section('content')

    <form action="{{ route('tablet.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>

    {{-- Log in with Google--}}
    <form action="{{ route('tablet.google.login') }}">
        <button>Login with Google</button>
    </form>

@endsection
