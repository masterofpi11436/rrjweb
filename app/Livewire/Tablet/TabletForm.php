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
    public $inmate_number, $first_name, $last_name, $middle_name, $date_found, $note;
    public $is_reported = false, $is_filed = false, $is_charged = false, $is_paid = false;

    // Field Rules
    protected $rules = [
        'inmate_number' => 'required|integer',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'middle_name' => 'nullable',
        'date_found' => 'nullable|date',
        'is_reported' => 'boolean',
        'is_filed' => 'boolean',
        'is_charged' => 'boolean',
        'is_paid' => 'boolean',
        'note' => 'nullable|string|max:1000',
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
            $this->is_reported = $tablet->is_reported;
            $this->is_filed = $tablet->is_filed;
            $this->is_charged = $tablet->is_charged;
            $this->is_paid = $tablet->is_paid;
            $this->note = $tablet->note;
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
