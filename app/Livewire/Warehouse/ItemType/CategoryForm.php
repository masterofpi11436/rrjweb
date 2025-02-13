<?php

namespace App\Livewire\Warehouse\Category;

use Livewire\Component;
use App\Models\Warehouse\Category;

class CategoryForm extends Component
{
    public $sectionId;
    public $section;

    public function mount($id = null)
    {
        if ($id) {
            $this->sectionId = $id;
            $this->loadSection();
        }
    }

    // Load the section data for editing
    public function loadSection()
    {
        $section = Category::find($this->sectionId);

        if ($section) {
            $this->section = $section->section;
        }
    }

    // Validation rules for the form
    protected function rules()
    {
        return [
            'section' => 'required|string|max:255',
        ];
    }

    // For live validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Handle the form submission
    public function submitForm()
    {
        $this->validate();

        if ($this->sectionId) {
            $section = Category::find($this->sectionId);
            session()->flash('create-edit-delete-message', 'Section updated successfully!');
        } else {
            // Create new user
            $section = new Category;
            session()->flash('create-edit-delete-message', 'Section created successfully!');
        }

        $section->section = $this->section;

        $section->save();

        return redirect()->route('warehouse.warehouse-supervisor.section.dashboard');
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Section.livewire.section-form');
    }
}
