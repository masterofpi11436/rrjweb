@extends('layouts.login')

@section('title', 'Administrator Login')

@section('heading', 'Administrator Login')

@section('content')
<h2>Hello World</h2>
<div>
    {{-- Admin forgot --}}
    <form action="{{ route('admin.forgot.form') }}">
        @csrf
        <button type="submit">Forgot Password</button>
    </form>
</div>

@endsection
