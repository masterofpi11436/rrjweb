@extends('layouts.administrator')

@section('title', 'Manage Users')

@section('heading', 'User Management')

@section('content')

<!-- Link to create a new user -->
<a href="">Add New User</a>

<!-- User List Table -->
<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Applications</th>
            <th>Roles</th>
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
                <td>
                    @foreach($user->applications as $application)
                        <div>{{ $user->roles->where('pivot.application_id', $application->id)->first()->name ?? 'No Role' }}</div>
                    @endforeach
                </td>
                <td>
                    <!-- Edit button -->
                    <a href="">Edit</a>

                    <!-- Delete form -->
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No users found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
