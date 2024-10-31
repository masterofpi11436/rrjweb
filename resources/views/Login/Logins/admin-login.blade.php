@extends('layouts.login')

@section('title', 'Administrator Login')

@section('heading', 'Administrator Login')

@section('content')

    <form action="{{ route('admin.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>

    {{-- Log in with Google--}}
    <form action="{{ route('admin.google.login') }}">
        <button>Login with Google</button>
    </form>

@endsection
