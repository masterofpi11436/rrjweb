@extends('layouts.login')

@section('title', 'VFM')

@section('heading', 'Vehicle Fleet Maintenance Admin Login')

@section('content')

<div>
    {{-- VFM Admin forgot --}}
    <form action="{{ route('vfm.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
