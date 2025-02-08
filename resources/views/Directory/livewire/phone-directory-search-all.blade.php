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
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $phone)
                    <tr>
                        <td>{{ $phone->name }}</td>
                        <td>{{ $phone->title }}</td>
                        <td>{{ $phone->section }}</td>
                        <td>{{ $phone->extension }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Extension Found.</h1>
        <p>Contact MIU to update the phone directory.</p>
    @endif
</div>
