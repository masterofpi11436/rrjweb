<div>

    <input type="text" wire:model.live="search" placeholder="Search directory...">

    <!-- Flash Message -->
    @if (session()->has('delete-message'))
        <div id="flash-message" class="flash-message">
            <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
            {{ session('delete-message') }}
        </div>
    @endif

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
                            <div>
                                <!-- Delete button -->
                                <a href="#" wire:click.prevent="confirmDelete({{ $suggestion->id }})">Delete</a>
                                <!-- Confirmation Modal -->
                                @if ($confirmingDelete)
                                    <div class="confirmation-modal">
                                        <div class="modal-content">
                                            <p>Are you sure you want to delete this extension?</p>
                                            <button class="btn-confirm" wire:click="deleteConfirmed">Yes, Delete</button>
                                            <button class="btn-cancel" wire:click="$set('confirmingDelete', false)">Cancel</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Record Found.</h1>
    @endif
</div>