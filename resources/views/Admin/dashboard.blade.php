@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Welcome to the Admin Dashboard!</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button>Logout</button>
    </form>
@endsection
