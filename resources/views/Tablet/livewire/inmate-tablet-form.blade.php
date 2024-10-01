<form wire:submit.prevent="submitForm">
    <div>
        <label for="inmate_number">Inmate Number:</label>
        <input id="inmate_number" type="text" wire:model.live="inmate_number">
        @error('inmate_number') <span>{{ $message }}</span> @enderror
    </div>
    
    <div>
        <label for="last_name">Last Name</label>
        <input id="last_name" type="text" wire:model.live="last_name">
        @error('last_name') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="first_name">First Name</label>
        <input id="first_name" type="text" wire:model.live="first_name">
        @error('first_name') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="middle_name">Middle Name</label>
        <input id="middle_name" type="text" wire:model.live="middle_name">
        @error('middle_name') <span>{{ $message }}</span> @enderror
    </div>    

    <div>
        <label for="date_tablet_found">Date Tablet was Found</label>
        <input id="date_tablet_found" type="date" wire:model.live="date_tablet_found">
        @error('date_tablet_found') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="is_101_incident_report_filed">Is the 101 Incident Report Filed?</label>
        <input id="is_101_incident_report_filed" type="checkbox" wire:model.live="is_101_incident_report_filed">
        @error('is_101_incident_report_filed') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="is_101_incident_report_filed">Is the 101 Incident Report Filed?</label>
        <input id="is_101_incident_report_filed" type="checkbox" wire:model.live="is_101_incident_report_filed">
        @error('is_101_incident_report_filed') <span>{{ $message }}</span> @enderror
    </div>
 
    <div>
        <button type="submit">Save Contact</button>
    </div>
</form>