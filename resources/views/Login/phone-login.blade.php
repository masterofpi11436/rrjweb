@extends('layouts.login')

@section('title', 'Phone Directory Login')

@section('heading', 'Phone Directory Login')

@section('content')

    <form method="POST" action="{{ route('login', ['app' => 'phone']) }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required autofocus>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
    
@endsection