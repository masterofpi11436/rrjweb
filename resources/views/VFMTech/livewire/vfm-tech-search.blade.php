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
                        <a href="#" wire:click.prevent="sortBy('vin')">
                            VIN
                            @if ($sortColumn === 'vin')
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
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $vehicle)
                    <tr>
                        <td>{{ $vehicle->maintenance_technician }}</td>
                        <td>{{ $vehicle->make }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->vin }}</td>
                        <td>{{ $vehicle->vehicle_year }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Record Found.</h1>
    @endif
</div>
