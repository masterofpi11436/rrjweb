<?php

namespace App\Livewire\Tablet;

use Livewire\Component;

// Required Models
use App\Models\Tablet\Tablet;

class TabletForm extends Component
{
    // For Editing Records
    public $tabletId;

    // Fields
    public $inmate_number, $first_name, $last_name, $middle_name, $date_found, $notes;
    public $charged_101 = false, $filed_with_inmate_accounts = false, $charged_by_inmate_accounts = false, $payment_status = false;

    // Field Rules
    protected $rules = [
        'inmate_number' => 'required|integer',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'middle_name' => 'nullable',
        'date_found' => 'nullable|date',
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
            $tablet = Tablet::findOrFail($id);
            $this->tabletId = $tablet->id;
            $this->inmate_number = $tablet->inmate_number;
            $this->first_name = $tablet->first_name;
            $this->last_name = $tablet->last_name;
            $this->middle_name = $tablet->middle_name;
            $this->date_found = optional($tablet->date_found)->format('Y-m-d');
            $this->charged_101 = $tablet->charged_101;
            $this->filed_with_inmate_accounts = $tablet->filed_with_inmate_accounts;
            $this->charged_by_inmate_accounts = $tablet->charged_by_inmate_accounts;
            $this->payment_status = $tablet->payment_status;
            $this->notes = $tablet->notes;
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

        if ($this->tabletId) {
            // Update existing entry
            $tablet = Tablet::findOrFail($this->tabletId);
            $tablet->update($validatedData);
            session()->flash('create-edit-delete-message', 'Record updated successfully!');
        } else {
            // Create new entry
            Tablet::create($validatedData);
            session()->flash('create-edit-delete-message', 'Record added successfully!');
        }

        // Redirect to index
        return redirect()->route('tablet.dashboard');
    }


    public function render()
    {
        return view('Tablet.livewire.tablet-form');
    }
}
