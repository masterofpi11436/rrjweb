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
                        <a href="#" wire:click.prevent="sortBy('vehicle_license_plate')">
                            License Plate
                            @if ($sortColumn === 'vehicle_license_plate')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('vehicle_make')">
                            Make
                            @if ($sortColumn === 'vehicle_make')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('vehicle_model')">
                            Model
                            @if ($sortColumn === 'vehicle_model')
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
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $vehicle)
                    <tr>
                        <td>{{ $vehicle->maintenance_technician }}</td>
                        <td>{{ $vehicle->vehicle_license_plate }}</td>
                        <td>{{ $vehicle->vehicle_make }}</td>
                        <td>{{ $vehicle->vehicle_model }}</td>
                        <td>{{ $vehicle->date_in }}</td>
                        <td>{{ $vehicle->date_out }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Record Found.</h1>
    @endif
</div>
