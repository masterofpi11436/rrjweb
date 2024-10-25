@extends('layouts.login')

@section('title', 'Phone Directory Login')

@section('heading', 'Phone Directory Login')

@section('content')

    <form action="{{ route('phone.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>

@endsection
