<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PhoneDirectory;

class PhoneDirectoryForm extends Component
{
    public $name;
    public $title;
    public $section;
    public $extension;

    protected $rules = [
        'name' => 'required|min:3',
        'title' => 'required|min:3|max:255',
        'section' => 'required|min:3|max:255',
        'extension' => 'required|numeric|digits_between:3,10',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
        PhoneDirectory::create($validatedData);

        // Reset the form after submission
        $this->reset(['name', 'title', 'section', 'extension']);

        // Redirect to the index page
        return redirect()->route('PhoneDirectory.index');
    }

    public function render()
    {
        return view('livewire.phone-directory-form');
    }
}

