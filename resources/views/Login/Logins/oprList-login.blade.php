@extends('layouts.login')

@section('title', 'OPR List Login')

@section('heading', 'OPR List Login')

@section('content')

<div class="google-login">
    {{-- Log in with Google --}}
    <form action="{{ route('google.login', ['app' => 'oprList']) }}">
        <button>
            <img src="{{asset('images/email-logo.jpg')}}" alt="Google">
            Login with Work Email</button>
    </form>
</div>

<div class="forgot-login">
    {{-- OPR List forgot --}}
    <form action="{{ route('oprList.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
