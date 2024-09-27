<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PhoneDirectory;

class PhoneDirectoryForm extends Component
{
    // Fields
    public $name;
    public $title;
    public $section;
    public $extension;

    // Field Rules
    protected $rules = [
        'name' => 'required|min:3',
        'title' => 'required|min:3|max:255',
        'section' => 'required|min:3|max:255',
        'extension' => 'required|numeric|digits_between:3,10',
    ];

    // Required for live validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Submit the form and redirect to the index page
    public function submitForm()
    {
        $validatedData = $this->validate();
        PhoneDirectory::create($validatedData);

        // Reset the form after submission
        $this->reset(['name', 'title', 'section', 'extension']);

        // Flash Message
        session()->flash('message', 'Contact added successfully!');

        // Redirect to the index page
        return redirect()->route('PhoneDirectory.index');
    }
}

