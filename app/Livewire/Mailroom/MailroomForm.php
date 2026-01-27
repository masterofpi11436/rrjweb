<?php

namespace App\Livewire\Mailroom;

use Livewire\Component;

// Required Models
use App\Models\Mailroom\Mailroom;

class MailroomForm extends Component
{
    // For Editing Records
    public $mailroomId;

    // Fields
    public $first_name, $last_name, $inmate_number;

    // Field Rules
    protected $rules = [
        'first_name' => 'max:255',
        'last_name' => 'max:255',
        'inmate_number' => 'max:255',
    ];

    // Method to load existing data if editing
    public function mount($id = null)
    {
        if ($id) {
            $mailroom = Mailroom::findOrFail($id);
            $this->mailroomId = $mailroom->id;
            $this->first_name = $mailroom->first_name;
            $this->last_name = $mailroom->last_name;
            $this->inmate_number = $mailroom->inmate_number;
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

        if ($this->mailroomId) {
            // Update existing entry
            $mailroom = Mailroom::findOrFail($this->mailroomId);
            $mailroom->update($validatedData);
            session()->flash('create-edit-delete-message', 'Inmate updated successfully!');
        } else {
            // Create new entry
            Mailroom::create($validatedData);
            session()->flash('create-edit-delete-message', 'Inamte added successfully!');
        }

        // Reset form fields
        $this->reset(['last_name', 'first_name', 'inmate_number']);

        // Redirect to index
        return redirect()->route('mailroom.dashboard');
    }

    public function render()
    {
        return view('Mailroom.livewire.mailroom-form');
    }
}
