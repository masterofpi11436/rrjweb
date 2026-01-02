@extends('layouts.login')

@section('title', 'Jurisdiction Logs Login')

@section('heading', 'Jurisdiction Logs Login')

@section('content')

<div>
    {{-- jurisdiction forgot --}}
    <form action="{{ route('jurisdiction.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
