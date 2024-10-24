@extends('layouts.login')

@section('title', 'Administrator Login')

@section('heading', 'Administrator Login')

@section('content')

    <form method="POST" action="#">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required autofocus>
        </div>
        @if ($errors->has('email_not_found'))
            <div style="color: red;">
                {{ $errors->first('email_not_found') }}
            </div>
        @endif

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
        @if ($errors->has('password_incorrect'))
            <div style="color: red;">
                {{ $errors->first('password_incorrect') }}
            </div>
        @endif

        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    @if ($errors->has('email'))
        <div style="color: red;">
            {{ $errors->first('email') }}
        </div>
    @endif

    @if ($errors->has('access_denied'))
        <div style="color: red;">
            {{ $errors->first('access_denied') }}
        </div>
    @endif

    @if ($errors->has('session_timeout'))
        <div style="color: red;">
            {{ $errors->first('access_denied') }}
        </div>
    @endif

    <form action="{{ route('login.forgot') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>

@endsection
