<div>

    <input type="text" wire:model.live="search" placeholder="Search inmates...">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('inmate_number')">
                            Inmate Number
                            @if ($sortColumn === 'inmate_number')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
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
                            First Name
                            @if ($sortColumn === 'first_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('middle_name')">
                            Middle Name
                            @if ($sortColumn === 'middle_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $oprList)
                    <tr>
                        <td>{{ $oprList->inmate_number }}</td>
                        <td>{{ $oprList->last_name }}</td>
                        <td>{{ $oprList->first_name }}</td>
                        <td>{{ $oprList->middle_name }}</td>
                        <td>
                            <a href="{{ route('oprList.edit', $oprList->id) }}">Edit</a>/
                            <div>
                                <!-- Delete link -->
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $oprList->id }});">Delete</a>
                                <form id="delete-form-{{ $oprList->id }}" action="{{ route('oprList.destroy', $oprList->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!-- Custom Confirmation Modal -->
                                <div id="custom-confirmation-modal-{{ $oprList->id }}" class="confirmation-modal" style="display: none;">
                                    <div class="modal-content">
                                        <p>Are you sure you want to delete this record?</p>
                                        <button class="btn-confirm" onclick="deleteRecord({{ $oprList->id }});">Yes, Delete</button>
                                        <button class="btn-cancel" onclick="hideModal({{ $oprList->id }});">Cancel</button>
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
