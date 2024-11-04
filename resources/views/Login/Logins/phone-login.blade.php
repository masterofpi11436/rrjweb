@extends('layouts.login')

@section('title', 'Phone Directory Login')

@section('heading', 'Phone Directory Login')

@section('content')

    <form action="{{ route('phone.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>

    {{-- Log in with Google--}}
    <form action="{{ route('google.login', ['app' => 'phone']) }}">
        <button>Login with Google</button>
    </form>

@endsection
