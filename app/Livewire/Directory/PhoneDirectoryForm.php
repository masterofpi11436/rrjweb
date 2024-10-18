<?php

namespace App\Livewire\Directory;

use Livewire\Component;

// Required Models
use App\Models\Directory\PhoneDirectory;

class PhoneDirectoryForm extends Component
{
    // For Editing Records
    public $phoneDirectoryId;

    // Fields
    public $name, $title, $section, $extension;

    // Field Rules
    protected $rules = [
        'name' => 'max:255',
        'title' => 'max:255',
        'section' => 'max:255',
        'extension' => 'required|min:4',
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
            session()->flash('create-edit-delete-message', 'Contact updated successfully!');
        } else {
            // Create new entry
            PhoneDirectory::create($validatedData);
            session()->flash('create-edit-delete-message', 'Contact added successfully!');
        }

        // Reset form fields
        $this->reset(['name', 'title', 'section', 'extension']);

        // Redirect to index
        return redirect()->route('phone.dashboard');
    }

    public function render()
    {
        return view('Directory.livewire.phone-directory-form');
    }
}
