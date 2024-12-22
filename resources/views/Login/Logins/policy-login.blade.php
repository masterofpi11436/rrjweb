@extends('layouts.login')

@section('title', 'Policy Login')

@section('heading', 'Policy Login')

@section('content')

<div>
    {{-- Policy forgot --}}
    <form action="{{ route('policy.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
