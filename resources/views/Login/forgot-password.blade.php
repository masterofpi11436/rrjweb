@extends('layouts.forgot')

@section('title', 'Forgot Password')

@section('heading', 'Forgot Password')

@section('content')

    @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.forgot') }}">
        @csrf

        <div>
            <label for="email">Email Address</label>
            <input type="email" name="email" autofocus>
        </div>
        @if ($errors->has('email_not_found'))
            <div style="color: red;">
                {{ $errors->first('email_not_found') }}
            </div>
        @endif

        <div>
            <button type="submit">Send Reset Link</button>
        </div>
    </form>

    <div>
        <a href="{{ route('admin.login') }}">Back to Login</a>
    </div>

@endsection
