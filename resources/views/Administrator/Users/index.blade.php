@extends('layouts.administrator')

@section('title', 'User Dashboard')

@section('heading', 'Manage Users')

@section('content')
<!-- Search form -->
<form method="GET" action="{{ route('admin.index') }}">
    <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search users...">
    <button type="submit">Search</button>
</form>

<!-- User List -->
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Application(s)</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->applications as $application)
                        <div>{{ $application->name }}</div>
                    @endforeach
                </td>
                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                <td>
                    <!-- Edit and Delete buttons -->
                    <a href="" class="btn btn-warning">Edit</a>

                    <form action="" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No users found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
