@extends('layouts.login')

@section('title', 'Tablet Login')

@section('heading', 'Tablet Login')

@section('content')

<div class="google-login">
    {{-- Log in with Google --}}
    <form action="{{ route('google.login', ['app' => 'tablet']) }}">
        <button>
            <img src="{{asset('images/email-logo.jpg')}}" alt="Google">
            Login with Work Email</button>
    </form>
</div>

<div class="forgot-login">
    {{-- Tablet forgot --}}
    <form action="{{ route('tablet.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
