<div>

    <input type="text" wire:model.live="search" placeholder="Search directory...">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('license_plate')">
                            License Plate
                            @if ($sortColumn === 'license_plate')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('make')">
                            Make
                            @if ($sortColumn === 'make')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('model')">
                            Model
                            @if ($sortColumn === 'model')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('year')">
                            Year
                            @if ($sortColumn === 'year')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('vin')">
                            VIN
                            @if ($sortColumn === 'vin')
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
                        <td>{{ $vehicle->license_plate }}</td>
                        <td>{{ $vehicle->make }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->vehicle_year }}</td>
                        <td>{{ $vehicle->vin }}</td>
                        <td>
                            <a href="{{ route('vfm-tech.vehicle.edit', $vehicle->id) }}">Edit</a>/
                            <div>
                                <!-- Delete link -->
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $vehicle->id }});">Delete</a>
                                <form id="delete-form-{{ $vehicle->id }}" action="{{ route('vfm-tech.vehicle.destroy', $vehicle->id) }}" method="POST" style="display: none;">
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
        <h1>No Record Foundssssssssssssssssssssssssssssssssssss.</h1>
    @endif
</div>
