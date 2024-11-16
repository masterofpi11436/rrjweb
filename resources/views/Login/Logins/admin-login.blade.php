@extends('layouts.login')

@section('title', 'Administrator Login')

@section('heading', 'Administrator Login')

@section('content')

<div class="google-login">
    {{-- Log in with Google --}}
    <form action="{{ route('google.login', ['app' => 'admin']) }}">
        <button>
            <img src="{{asset('images/email-logo.jpg')}}" alt="Google">
            Login with Work Email</button>
    </form>
</div>

<div class="forgot-login">
    {{-- Admin forgot --}}
    <form action="{{ route('admin.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
