<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Item;
use App\Http\Controllers\Controller;

// CRUD operations for items available in the warehouse store
class ItemController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.Item.item.dashboard');
    }

    // Create new entry
    public function create()
    {
        return view('Warehouse.WarehouseSupervisor.Item.item.create');
    }

    // Display the form to edit an existing item
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('Warehouse.WarehouseSupervisor.Item.item.edit', ['item' => $item]);
    }

    // Delete an existing item
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        session()->flash('create-edit-delete-message', 'Item deleted successfully!');
        return redirect()->back();
    }
}
