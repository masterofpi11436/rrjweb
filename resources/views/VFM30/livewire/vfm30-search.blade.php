<div>

    <input type="text" wire:model.live="search" placeholder="Search directory...">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('maintenance_technician')">
                            Technician
                            @if ($sortColumn === 'maintenance_technician')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('license_plate')">
                            License Plate
                            @if ($sortColumn === 'license_plate')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('date_in')">
                            Date In
                            @if ($sortColumn === 'date_in')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('date_out')">
                            Date Out
                            @if ($sortColumn === 'date_out')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('vehicle_year')">
                            Year
                            @if ($sortColumn === 'vehicle_year')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $vehicle)
                    <tr>
                        <td>{{ $vehicle->maintenance_technician }}</td>
                        <td>{{ $vehicle->license_plate }}</td>
                        <td>{{ $vehicle->date_in }}</td>
                        <td>{{ $vehicle->date_out }}</td>
                        <td>{{ $vehicle->vehicle_year }}</td>
                        <td>
                            <a href="{{ route('vfm30.edit', $vehicle->id) }}">Edit</a>/
                            <div>
                                <!-- Delete link -->
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $vehicle->id }});">Delete</a>
                                <form id="delete-form-{{ $vehicle->id }}" action="{{ route('vfm.destroy', $vehicle->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!-- Custom Confirmation Modal -->
                                <div id="custom-confirmation-modal-{{ $vehicle->id }}" class="confirmation-modal" style="display: none;">
                                    <div class="modal-content">
                                        <p>Are you sure you want to delete this record?</p>
                                        <button class="btn-confirm" onclick="deleteRecord({{ $vehicle->id }});">Yes, Delete</button>
                                        <button class="btn-cancel" onclick="hideModal({{ $vehicle->id }});">Cancel</button>
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
