@extends('layouts.Training.admin')

@section('title', 'Training Administration Dashboard')

@section('heading', 'Training Administration Dashboard')

@section('content')

    <form action="{{ route('training.admin.user.dashboard') }}">
        <button>Users</button>
    </form>

    <form action="{{ route('training.admin.books.dashboard') }}">
        <button>Manage Books</button>
    </form>

    <form action="">
        <button>User Training Statuses</button>
    </form>

    <form action="">
        <button>Manage Training Materials</button>
    </form>

@endsection
