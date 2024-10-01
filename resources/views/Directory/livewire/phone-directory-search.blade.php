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
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $suggestion->id }});">Delete</a>
                                <form id="delete-form-{{ $suggestion->id }}" action="{{ route('Directory.PhoneDirectory.destroy', $suggestion->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <!-- Custom Confirmation Modal -->
                                <div id="custom-confirmation-modal-{{ $suggestion->id }}" class="confirmation-modal" style="display: none;">
                                    <div class="modal-content">
                                        <p>Are you sure you want to delete this extension?</p>
                                        <button class="btn-confirm" onclick="deleteRecord({{ $suggestion->id }});">Yes, Delete</button>
                                        <button class="btn-cancel" onclick="hideModal({{ $suggestion->id }});">Cancel</button>
                                    </div>
                                </div>
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