<form wire:submit.prevent="submitForm">
    <div>
        <label for="name">Name:</label>
        <input id="name" type="text" wire:model.live="name">
        @error('name') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <button type="submit">{{ $jurisdictionId ? 'Update Jurisdiction' : 'Create Jurisdiction' }}</button>
    </div>

    <h2>Existing Jurisdictions</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jurisdictions as $j)
                <tr>
                    <td>{{ $j->name }}</td>
                    <td>
                        <a href="#"
                        wire:click.prevent="editJurisdiction({{ $j->id }})">
                        Edit
                        </a>
                        |
                        <a href="#"
                        style="color: red; margin-left: 0.5rem;"
                        wire:click.prevent="deleteJurisdiction({{ $j->id }})"
                        onclick="return confirm('Are you sure you want to delete this jurisdiction?')">
                        Delete
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No jurisdictions available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</form>
