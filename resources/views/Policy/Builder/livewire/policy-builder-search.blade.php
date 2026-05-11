<div>

    <input type="text" wire:model.live="search" placeholder="Search policies...">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('title')">
                            Title
                            @if ($sortColumn === 'title')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $policy)
                    <tr>
                        <td>
                            <a href="{{ asset('storage/' . $policy->pdf) }}{{ $search ? '#search=' . urlencode($search) : '' }}" target="_blank">
                                {{ $policy->title }}
                            </a>
                        </td>
                        <td>
                            <div>
                                <!-- Delete link -->
                                <a href="{{ route('policy.edit', $policy->id) }}">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Policy Found.</h1>
    @endif
</div>
