@extends('layouts.login')

@section('title', 'CellFlow Login')

@section('heading', 'CellFlow Login')

@section('content')

    <div>
        {{-- CellFlow forgot --}}
        <form action="{{ route('cellflow.forgot.form') }}">
            @csrf
            <button type="submit">Forgot Password</button>
        </form>
    </div>

@endsection
