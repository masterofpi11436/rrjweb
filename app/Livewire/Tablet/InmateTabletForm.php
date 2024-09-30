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
    public $inmateNumber, $lastName, $firstName, $middleName, 
           $dateTabletFound, $is101IncidentReportFiled, $isFiledByInmateAccounts, 
           $isChargedByInmateAccounts, $isPayed, $notes;
    
    protected $rules = [
        'inmateNumber' => 'required|min:5|max:255',
        'lastName' => 'required|max:255',
        'firstName' => 'required|max:255',
        'middleName' => 'nullable|max:255',
        'dateTabletFound' => 'nullable',
        'is101IncidentReportFiled' => 'nullable|boolean',
        'isFiledByInmateAccounts' => 'nullable|boolean',
        'isChargedByInmateAccounts' => 'nullable|boolean',
        'isPayed' => 'nullable|boolean',
        'notes' => 'nullable'
    ];

    public function mount($id = null)
    {
        if ($id) {
            $inmateRecord = InmateTablet::findOrFail($id);
            $this->inmateNumber = $inmateRecord->inmate_number;
            $this->lastName = $inmateRecord->last_name;
            $this->firstName = $inmateRecord->first_name;
            $this->middleName = $inmateRecord->middle_name;
            $this->dateTabletFound = $inmateRecord->date_tablet_found;
            $this->is101IncidentReportFiled = $inmateRecord->is_101_incident_report_filed;
            $this->isFiledByInmateAccounts = $inmateRecord->is_filed_by_inmate_accounts;
            $this->isChargedByInmateAccounts = $inmateRecord->is_charged_by_inmate_accounts;
            $this->isPayed = $inmateRecord->is_payed;
            $this->notes = $inmateRecord->notes;
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
        $validatedData = $this->validate();

        if ($this->inmateTabletId) {
            // Update existing entry
            $inmateRecord = InmateTablet::findOrFail($this->inmateTabletId);
            $inmateRecord->update($validatedData);
            session()->flash('message', 'Inmate tablet status updated successfully!');
        } else {
            // Create new entry
            InmateTablet::create($validatedData);
            session()->flash('message', 'Inmate tablet status added successfully!');
        }

        // Reset form fields
        $this->reset(['inmateNumber',
                      'lastName',
                      'firstName',
                      'middleName',
                      'dateTabletFound',
                      'is101IncidentReportFiled',
                      'isFiledByInmateAccounts',
                      'isChargedByInmateAccounts',
                      'isPayed',
                      'notes']);
        
        // Redirect index
        return redirect()->route('Tablet.InmateTablet.index');
    }

    public function render()
    {
        return view('Tablet.livewire.inmate-tablet-form');
    }
}
