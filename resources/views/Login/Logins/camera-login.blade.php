@extends('layouts.login')

@section('title', 'Camera Schedule Login')

@section('heading', 'Camera Schedule Login')

@section('content')

<div>
    {{-- Camera forgot --}}
    <form action="{{ route('camera.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
