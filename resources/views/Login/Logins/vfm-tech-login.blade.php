@extends('layouts.login')

@section('title', 'VFM Tech')

@section('heading', 'Vehicle Fleet Maintenance Tech Login')

@section('content')

<div class="google-login">
    {{-- Log in with Google --}}
    <form action="{{ route('google.login', ['app' => 'vfm-tech']) }}">
        <button>
            <img src="{{asset('images/email-logo.jpg')}}" alt="Google">
            Login with Work Email</button>
    </form>
</div>

<div class="forgot-login">
    {{-- VFM Tech forgot --}}
    <form action="{{ route('vfm-tech.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
