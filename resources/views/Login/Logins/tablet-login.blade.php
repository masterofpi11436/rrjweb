@extends('layouts.login')

@section('title', 'Tablet Login')

@section('heading', 'Tablet Login')

@section('content')

    <form action="{{ route('tablet.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>

@endsection
