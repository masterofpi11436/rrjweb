@extends('layouts.administrator')

@section('title', 'Create New User')

@section('heading', 'Create New User')

@section('content')

<a href="{{ route('admin.index') }}">Back</a>

<form action="/user/store" method="POST">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="applications">Applications & Roles</label>
    @foreach ($applications as $application)
        <h4>{{ $application->name }}</h4>

        @foreach ($application->roles as $role)
            <input type="checkbox" name="roles[{{ $application->id }}][]" value="{{ $role->id }}">
            <label>{{ $role->name }}</label>
        @endforeach
    @endforeach

    <button type="submit">Create User</button>
</form>


@endsection
