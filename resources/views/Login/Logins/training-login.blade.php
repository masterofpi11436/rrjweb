@extends('layouts.login')

@section('title', 'Training Login')

@section('heading', 'Training Login')

@section('content')

    <div>
        {{-- Training forgot --}}
        <form action="{{ route('training.forgot.form') }}">
            @csrf
            <button type="submit">Forgot Password</button>
        </form>
    </div>

@endsection
