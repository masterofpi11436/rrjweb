<?php

namespace App\Livewire\Warehouse\Category;

use Livewire\Component;
use App\Models\Warehouse\Category;

class CategoryForm extends Component
{
    public $categoryId;
    public $category;

    public function mount($id = null)
    {
        if ($id) {
            $this->categoryId = $id;
            $this->loadCategory();
        }
    }

    // Load the section data for editing
    public function loadCategory()
    {
        $category = Category::find($this->categoryId);

        if ($category) {
            $this->category = $category->category;
        }
    }

    // Validation rules for the form
    protected function rules()
    {
        return [
            'category' => 'required|string|max:255',
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

        if ($this->categoryId) {
            $category = Category::find($this->categoryId);
            session()->flash('create-edit-delete-message', 'Section updated successfully!');
        } else {
            // Create new user
            $category = new Category;
            session()->flash('create-edit-delete-message', 'Section created successfully!');
        }

        $category->category = $this->category;

        $category->save();

        return redirect()->route('warehouse.warehouse-supervisor.category.dashboard');
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Category.livewire.category-form');
    }
}
