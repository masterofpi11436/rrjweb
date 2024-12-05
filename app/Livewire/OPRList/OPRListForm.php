<?php

namespace App\Livewire\OPRList;

use Livewire\Component;

// Required Models
use App\Models\OPR\OPRList;

class OPRListForm extends Component
{
    // For Editing Records
    public $oprListId;

    // Fields
    public $inmate_number, $last_name, $first_name, $middle_name;

    protected $rules = [
        'inmate_number' => 'required|numeric|digits_between:5,11',
        'last_name' => 'required|max:255',
        'first_name' => 'required|max:255',
        'middle_name' => 'nullable|max:255',
    ];

    public function mount($id = null)
    {
        if ($id) {
            // Editing an existing record
            $inmateRecord = OPRList::findOrFail($id);
            $this->oprListId = $inmateRecord->id;
            $this->inmate_number = $inmateRecord->inmate_number;
            $this->last_name = $inmateRecord->last_name;
            $this->first_name = $inmateRecord->first_name;
            $this->middle_name = $inmateRecord->middle_name;
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

        if ($this->oprListId) {
            // Update existing entry
            $oprList = OPRList::findOrFail($this->oprListId);
            $oprList->update($validatedData);
            session()->flash('create-edit-delete-message', 'Inmate updated successfully!');
        } else {
            // Create new entry
            OPRList::create($validatedData);
            session()->flash('create-edit-delete-message', 'Inmate added successfully!');
        }

        // Reset form fields
        $this->reset(['inmate_number', 'last_name', 'first_name', 'middle_name']);

        // Redirect to index
        return redirect()->route('oprList.dashboard');
    }

    public function render()
    {
        return view('OPR.livewire.oprList-form');
    }
}
