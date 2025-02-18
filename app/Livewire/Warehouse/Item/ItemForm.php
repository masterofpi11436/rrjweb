<?php

namespace App\Livewire\Warehouse\Item;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Category;
use Illuminate\Support\Facades\Storage;

class ItemForm extends Component
{
    use WithFileUploads;

    public $itemId;
    public $name;
    public $category_id;
    public $category_name;
    public $image;
    public $imagePreview;
    public $quantity;
    public $low_stock_threshold;
    public $categories = []; // Holds all categories

    public function mount($id = null)
    {
        $this->categories = Category::all(); // Fetch categories for dropdown

        if ($id) {
            $this->itemId = $id;
            $this->loadItem();
        }
    }

    public function loadItem()
    {
        $item = Item::find($this->itemId);

        if ($item) {
            $this->name = $item->name;
            $this->category_id = $item->category_id;
            $this->category_name = $item->category_name;
            $this->quantity = $item->quantity;
            $this->low_stock_threshold = $item->low_stock_threshold;
            $this->imagePreview = $item->image ? asset('storage/' . $item->image) : asset('images/default-image.jpg');
        }
    }

    public function removeImage()
    {
        if ($this->itemId) {
            $item = Item::find($this->itemId);

            if ($item && $item->image) {
                // Delete the image from storage
                Storage::disk('public')->delete($item->image);

                // Remove the image reference from the database
                $item->image = null;
                $item->save();
            }
        }

        // Clear the component's image data
        $this->image = null;
        $this->imagePreview = null;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // Allow image uploads, max size 2MB
            'quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
        ];
    }

    public function updatedCategoryId()
    {
        $category = Category::find($this->category_id);
        $this->category_name = $category ? $category->name : 'Unknown';
    }

    public function updatedImage()
    {
        if ($this->image) {
            $this->imagePreview = $this->image->temporaryUrl();
        }
    }

    public function submitForm()
    {
        $this->validate();

        $item = $this->itemId ? Item::findOrFail($this->itemId) : new Item();

        $item->name = $this->name;
        $item->category_id = $this->category_id;
        $item->category_name = $this->category_name;
        $item->quantity = $this->quantity;
        $item->low_stock_threshold = $this->low_stock_threshold;

        // Preserve original filename when storing image
        if ($this->image) {
            $originalFilename = $this->image->getClientOriginalName(); // Get original name
            $filename = Str::slug(pathinfo($originalFilename, PATHINFO_FILENAME)) . '.' . $this->image->getClientOriginalExtension(); // Sanitize filename
            $path = $this->image->storeAs('item-images', $filename, 'public'); // Store with original name
            $item->image = $path; // Save path to DB
        }

        $item->save();

        session()->flash('create-edit-delete-message', $this->itemId ? 'Item updated successfully!' : 'Item created successfully!');

        return redirect()->route('warehouse.warehouse-supervisor.item.dashboard');
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Item.livewire.item-form');
    }
}
