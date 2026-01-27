@extends('layouts.forgot')

@section('title', 'Forgot Password')

@section('heading', 'Forgot Password')

@section('content')

    <div>
        <a href="{{ route('mailroom.login') }}">Back to Login</a>
    </div>

@endsection
