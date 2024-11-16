@extends('layouts.login')

@section('title', 'Phone Directory Login')

@section('heading', 'Phone Directory Login')

@section('content')

<div class="google-login">
    {{-- Log in with Google --}}
    <form action="{{ route('google.login', ['app' => 'phone']) }}">
        <button>
            <img src="{{asset('images/email-logo.jpg')}}" alt="Google">
            Login with Work Email</button>
    </form>
</div>

<div class="forgot-login">
    {{-- Phone forgot --}}
    <form action="{{ route('phone.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
