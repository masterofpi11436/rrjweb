<div>
    <input type="text" wire:model="search" placeholder="Search users...">

    <table>
        <thead>
            <tr>
                <th><a href="#" wire:click="sortBy('first_name')">First Name</a></th>
                <th><a href="#" wire:click="sortBy('last_name')">Last Name</a></th>
                <th><a href="#" wire:click="sortBy('email')">Email</a></th>
                <th><a href="#" wire:click="sortBy('admin')">Admin Access</a></th>
                <th><a href="#" wire:click="sortBy('phone')">Phone Access</a></th>
                <th><a href="#" wire:click="sortBy('tablet')">Tablet Access</a></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suggestions as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->admin ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->phone ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->tablet ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $user->id) }}">Edit</a>
                        <button wire:click="confirmDelete({{ $user->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
