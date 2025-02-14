@extends('layouts.login')

@section('title', 'VFM Tech')

@section('heading', 'Vehicle Fleet Maintenance Tech Login')

@section('content')

<div>
    {{-- VFM Tech forgot --}}
    <form action="{{ route('vfm-tech.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
