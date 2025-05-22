<?php

namespace App\Livewire\Jurisdiction;

use Livewire\Component;

// Required Models
use App\Models\Jurisdiction\Jurisdiction;

class JurisdictionForm extends Component
{
    public $jurisdictionId;
    public $jurisdictions = [];

    public $name;

    protected $rules = [
        'name' => 'max:255|required',
    ];

    // Method to load existing data if editing
    public function mount($id = null)
    {
        $this->jurisdictions = Jurisdiction::orderBy('name')->get();

        if ($id) {
            $jurisdiction = Jurisdiction::findOrFail($id);
            $this->jurisdictionId = $jurisdiction->id;
            $this->name = $jurisdiction->name;
        }
    }

    public function editJurisdiction($id)
    {
        $jurisdiction = Jurisdiction::findOrFail($id);
        $this->jurisdictionId = $jurisdiction->id;
        $this->name = $jurisdiction->name;
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

        if ($this->jurisdictionId) {
            $jurisdiction = Jurisdiction::findOrFail($this->jurisdictionId);
            $jurisdiction->update($validatedData);
            session()->flash('create-edit-delete-message', "Jurisdiction '{$jurisdiction->name}' updated successfully!");
        } else {
            $jurisdiction = Jurisdiction::create($validatedData);
            session()->flash('create-edit-delete-message', "Jurisdiction '{$jurisdiction->name}' added successfully!");
        }

        // Reset form fields
        $this->reset(['name']);

        // Redirect to index
        return redirect()->route('jurisdiction.dashboard');
    }

    public function render()
    {
        return view('Jurisdiction.livewire.jurisdiction-form');
    }
}
