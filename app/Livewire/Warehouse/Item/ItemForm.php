<?php

namespace App\Livewire\Warehouse\Item;

use Livewire\Component;
use App\Models\Warehouse\Item;

class ItemForm extends Component
{
    public $itemId;
    public $name;
    public $category_id;
    public $category_name;
    public $image;
    public $quantity;
    public $low_stock_threshold;

    public function mount($id = null)
    {
        if ($id) {
            $this->itemId = $id;
            $this->loadItem();
        }
    }

    // Load the section data for editing
    public function loadItem()
    {
        $item = Item::find($this->itemId);

        if ($item) {
            $this->name = $item->name;
            $this->category_id = $item->category_id;
            $this->category_name = $item->category_name;
            $this->image = $item->image;
            $this->quantity = $item->quantity;
            $this->low_stock_threshold = $item->low_stock_threshold;
        }
    }

    // Validation rules for the form
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'category_name' => 'required',
            'image' => 'mimes:jpg',
            'quantity' => 'required|integer',
            'low_stock_threshold' => 'required|integer',
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

        if ($this->itemId) {
            $item = Item::find($this->itemId);
            session()->flash('create-edit-delete-message', 'Item updated successfully!');
        } else {
            // Create new user
            $item = new Item;
            session()->flash('create-edit-delete-message', 'Item created successfully!');
        }

        $item->name = $this->name;

        $item->save();

        return redirect()->route('warehouse.warehouse-supervisor.item.dashboard');
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Item.livewire.item-form');
    }
}
