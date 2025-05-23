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

    public function deleteJurisdiction($id)
    {
        $jurisdiction = Jurisdiction::findOrFail($id);
        $jurisdiction->delete();
        $this->jurisdictions = Jurisdiction::orderBy('name')->get();
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
        } else {
            $jurisdiction = Jurisdiction::create($validatedData);
        }

        return redirect()->route('jurisdiction.create');
    }

    public function render()
    {
        return view('Jurisdiction.livewire.jurisdiction-form');
    }
}
