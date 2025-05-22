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
    <p>Click the name to edit</p>
    <ul>
        @foreach($jurisdictions as $j)
            <li>
                <a href="#" wire:click.prevent="editJurisdiction({{ $j->id }})">
                    {{ $j->name }}
                </a>
            </li>
        @endforeach
    </ul>
</form>
