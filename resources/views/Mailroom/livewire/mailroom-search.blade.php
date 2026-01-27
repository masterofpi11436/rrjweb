<div>

    <input type="text" wire:model.live="search" placeholder="Search Inmates...">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('last_name')">
                            Last Name
                            @if ($sortColumn === 'last_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('first_name')">
                            first_name
                            @if ($sortColumn === 'first_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('inmate_number')">
                            inmate_number
                            @if ($sortColumn === 'inmate_number')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $mailroom)
                    <tr>
                        <td>{{ $mailroom->last_name }}</td>
                        <td>{{ $mailroom->first_name }}</td>
                        <td>{{ $mailroom->inmate_number }}</td>
                        <td>
                            <a href="{{ route('mailroom.edit', $mailroom->id) }}">Edit</a>/
                            <div>
                                <!-- Delete link -->
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $mailroom->id }});">Delete</a>
                                <form id="delete-form-{{ $mailroom->id }}" action="{{ route('mailroom.destroy', $mailroom->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!-- Custom Confirmation Modal -->
                                <div id="custom-confirmation-modal-{{ $mailroom->id }}" class="confirmation-modal" style="display: none;">
                                    <div class="modal-content">
                                        <p>Are you sure you want to delete this inmate?</p>
                                        <button class="btn-confirm" onclick="deleteRecord({{ $mailroom->id }});">Yes, Delete</button>
                                        <button class="btn-cancel" onclick="hideModal({{ $mailroom->id }});">Cancel</button>
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
