<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PhoneDirectory;

class PhoneDirectoryForm extends Component
{
    // For Editing Records
    public $phoneDirectoryId;

    // Fields
    public $name, $title, $section, $extension;

    // Field Rules
    protected $rules = [
        'name' => 'required|min:3|max:255',
        'title' => 'required|max:255',
        'section' => 'required|min:3|max:255',
        'extension' => 'required|numeric|digits_between:4,10',
    ];

    // Method to load existing data if editing
    public function mount($id = null)
    {
        if ($id) {
            $phoneDirectory = PhoneDirectory::findOrFail($id);
            $this->phoneDirectoryId = $phoneDirectory->id;
            $this->name = $phoneDirectory->name;
            $this->title = $phoneDirectory->title;
            $this->section = $phoneDirectory->section;
            $this->extension = $phoneDirectory->extension;
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

        if ($this->phoneDirectoryId) {
            // Update existing entry
            $phoneDirectory = PhoneDirectory::findOrFail($this->phoneDirectoryId);
            $phoneDirectory->update($validatedData);
            session()->flash('message', 'Contact updated successfully!');
        } else {
            // Create new entry
            PhoneDirectory::create($validatedData);
            session()->flash('message', 'Contact added successfully!');
        }

        // Reset form fields
        $this->reset(['name', 'title', 'section', 'extension']);
        
        // Redirect to index
        return redirect()->route('PhoneDirectory.index');
    }
}