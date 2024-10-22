<?php

namespace App\Livewire\Tablet;

use Livewire\Component;

// Required Models
use App\Models\Tablet\InmateTablet;

class InmateTabletForm extends Component
{
    // For Editing Records
    public $inmateTabletId;

    // Fields
    public $inmate_info, $inmate_number, $last_name, $first_name, $middle_name,
           $date_tablet_found, $is_101_incident_report_filed, $is_filed_by_inmate_accounts,
           $is_charged_by_inmate_accounts, $is_payed, $notes;

    protected $rules = [
        'inmate_number' => 'required|numeric|digits_between:5,11',
        'last_name' => 'required|max:255',
        'first_name' => 'required|max:255',
        'middle_name' => 'nullable|max:255',
        'date_tablet_found' => 'nullable',
        'is_101_incident_report_filed' => 'boolean',
        'is_filed_by_inmate_accounts' => 'boolean',
        'is_charged_by_inmate_accounts' => 'boolean',
        'is_payed' => 'boolean',
        'notes' => 'nullable'
    ];

    public function updatedInmateInfo()
    {
        $this->combinedInmateInfoSplitter();
    }

    public function combinedInmateInfoSplitter()
    {
        $cleanPastedInfo = str_replace(',', '', $this->inmate_info);

        $data = explode(' ', $cleanPastedInfo);

        if (count($data) >= 3) {
            $this->inmate_number = $data[0];
            $this->last_name = $data[1];
            $this->first_name = $data[2];

            if (count($data) > 3) {
                $this->middle_name = implode(' ', array_slice($data, 3));
            } else {
                $this->middle_name = null;
            }

        } else {
            session()->flash('error', 'Invalid format, please use the format ##### Last Name First Name');
        }
    }

    public function mount($id = null)
    {
        if ($id) {
            // Editing an existing record
            $inmateRecord = InmateTablet::findOrFail($id);
            $this->inmateTabletId = $inmateRecord->id;
            $this->inmate_number = $inmateRecord->inmate_number;
            $this->last_name = $inmateRecord->last_name;
            $this->first_name = $inmateRecord->first_name;
            $this->middle_name = $inmateRecord->middle_name;
            $this->date_tablet_found = $inmateRecord->date_tablet_found;
            $this->is_101_incident_report_filed = (bool) $inmateRecord->is_101_incident_report_filed ?? false;
            $this->is_filed_by_inmate_accounts = (bool) $inmateRecord->is_filed_by_inmate_accounts ?? false;
            $this->is_charged_by_inmate_accounts = (bool) $inmateRecord->is_charged_by_inmate_accounts ?? false;
            $this->is_payed = (bool) $inmateRecord->is_payed ?? false;
            $this->notes = $inmateRecord->notes;
        } else {
            // Creating a new record - set defaults
            $this->is_101_incident_report_filed = false; // Set to false by default
            $this->is_filed_by_inmate_accounts = false;   // Set to false by default
            $this->is_charged_by_inmate_accounts = false; // Set to false by default
            $this->is_payed = false;                      // Set to false by default
        }
    }

    // Required for live validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Handle form submission for both create and update
    public function submitForm()
    {
        $validateOnly = $this->validate();

        if ($this->inmateTabletId) {
            $inmate_record = InmateTablet::findOrFail($this->inmateTabletId);
            $inmate_record->update($validateOnly);
            session()->flash('create-edit-delete-message', 'Inmate tablet status updated successfully!');
        } else {
            InmateTablet::create($validateOnly);
            session()->flash('create-edit-delete-message', 'Inmate tablet status added successfully!');
        }

        // Reset form fields
        $this->reset();

        return redirect()->route('tablet.dashboard');
    }

    public function render()
    {
        return view('Tablet.livewire.inmate-tablet-form');
    }
}
