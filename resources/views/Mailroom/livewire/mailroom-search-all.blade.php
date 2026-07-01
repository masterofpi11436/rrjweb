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
                                @if ($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('first_name')">
                            first_name
                            @if ($sortColumn === 'first_name')
                                @if ($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('inmate_number')">
                            inmate_number
                            @if ($sortColumn === 'inmate_number')
                                @if ($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $mailroom)
                    <tr>
                        <td>{{ $mailroom->last_name }}</td>
                        <td>{{ $mailroom->first_name }}</td>
                        <td>{{ $mailroom->inmate_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Record Found.</h1>
    @endif
</div>
