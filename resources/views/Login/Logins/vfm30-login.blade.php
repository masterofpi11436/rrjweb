@extends('layouts.login')

@section('title', 'VFM30')

@section('heading', 'Vehicle Fleet Maintenance 30 Admin Login')

@section('content')

<div>
    {{-- VFM 30 Admin forgot --}}
    <form action="{{ route('vfm30.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
