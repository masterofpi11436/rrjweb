<div>

    <input type="text" wire:model.live="search" placeholder="Search directory..." class="form-control">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('name')">
                            Name
                            @if ($sortColumn === 'name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('title')">
                            Title
                            @if ($sortColumn === 'title')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('section')">
                            Section
                            @if ($sortColumn === 'section')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('extension')">
                            Extension
                            @if ($sortColumn === 'extension')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $suggestion)
                    <tr>
                        <td>{{ $suggestion->name }}</td>
                        <td>{{ $suggestion->title }}</td>
                        <td>{{ $suggestion->section }}</td>
                        <td>{{ $suggestion->extension }}</td>
                        <td>
                            <a href="{{ route('Directory.PhoneDirectory.edit', $suggestion->id) }}">Edit</a>/
                            <a href="#" wire:click.prevent="delete({{ $suggestion->id }})" class="text-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Record Found.</h1>
    @endif
</div>