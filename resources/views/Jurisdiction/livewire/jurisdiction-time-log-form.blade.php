<form wire:submit.prevent="submitForm">
    <div>
        <label>Jurisdiction</label>
        <select wire:model="jurisdiction_id">
            <option value="">-- Select --</option>
            @foreach ($jurisdictions as $j)
                <option value="{{ $j->id }}">{{ $j->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Date of Visit</label>
        <input type="date" wire:model="date_of_visit">
    </div>

    <div><label>Arrival Time</label>
        <input type="time" wire:model="arrival_time">
    </div>
    <div>
        <label>Departure Time</label>
        <input type="time" wire:model="departure_time">
    </div>
    <div>
        <label>Magistrate Start</label>
        <input type="time" wire:model="magistrate_start">
    </div>
    <div>
        <label>Magistrate End</label>
        <input type="time" wire:model="magistrate_end">
    </div>
    <div>
        <label>Nurse Start</label>
        <input type="time" wire:model="nurse_start">
    </div>
    <div>
        <label>Nurse End</label>
        <input type="time" wire:model="nurse_end">
    </div>

    <div>
        <label><input type="checkbox" wire:model="did_not_get_committed"> Rejected</label>
    </div>

    <div>
        <label>Note</label>
        <textarea wire:model="note"></textarea>
    </div>

    <button type="submit">{{ $logId ? 'Update' : 'Create' }} Time Log</button>
</form>
