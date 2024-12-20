<?php

namespace App\Livewire\ICS;

use Livewire\Component;

// Required Models
use App\Models\ICS\ICS;

class ICSForm extends Component
{
    // For Editing Records
    public $icsId;

    // Fields
    public $inmate_number, $first_name, $last_name, $middle_name, $date_found, $notes;
    public $charged_101 = false, $filed_with_inmate_accounts = false, $charged_by_inmate_accounts = false, $payment_status = false;

    // Field Rules
    protected $rules = [
        'inmate_number' => 'required|integer',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'middle_name' => 'nullable',
        'date_found' => 'nullable',
        'charged_101' => 'boolean',
        'filed_with_inmate_accounts' => 'boolean',
        'charged_by_inmate_accounts' => 'boolean',
        'payment_status' => 'boolean',
        'notes' => 'nullable|string|max:1000',
    ];

    // Method to load existing data if editing
    public function mount($id = null)
    {
        if ($id) {
            $ics = ICS::findOrFail($id);
            $this->icsId = $ics->id;
            $this->inmate_number = $ics->inmate_number;
            $this->first_name = $ics->first_name;
            $this->last_name = $ics->last_name;
            $this->middle_name = $ics->middle_name;
            $this->date_found = $ics->date_found;
            $this->charged_101 = $ics->charged_101;
            $this->filed_with_inmate_accounts = $ics->filed_with_inmate_accounts;
            $this->charged_by_inmate_accounts = $ics->charged_by_inmate_accounts;
            $this->payment_status = $ics->payment_status;
            $this->notes = $ics->notes;
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

        if ($this->icsId) {
            // Update existing entry
            $ics = ICS::findOrFail($this->icsId);
            $ics->update($validatedData);
            session()->flash('create-edit-delete-message', 'Record updated successfully!');
        } else {
            // Create new entry
            ICS::create($validatedData);
            session()->flash('create-edit-delete-message', 'Record added successfully!');
        }

        // Redirect to index
        return redirect()->route('ics.dashboard');
    }


    public function render()
    {
        return view('ICS.livewire.ics-form');
    }
}
