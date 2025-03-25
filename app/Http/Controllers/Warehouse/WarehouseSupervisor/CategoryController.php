<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

// CRUD operations for item categories
class CategoryController extends Controller
{
    protected $pendingOrdersCount;
    protected $pendingExchangeOrdersCount;

    public function __construct()
    {
        // Make pending orders count available to all views
        $this->pendingOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))->count();
        $this->pendingExchangeOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'))->count();
        View::share(['pendingOrdersCount' => $this->pendingOrdersCount,
                     'pendingExchangeOrdersCount' => $this->pendingExchangeOrdersCount]);
    }

    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.Category.category.dashboard');
    }

    // Create new entry
    public function create()
    {
        return view('Warehouse.WarehouseSupervisor.Category.category.create');
    }

    // Display the form to edit an existing category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Warehouse.WarehouseSupervisor.Category.category.edit', ['category' => $category]);
    }

    // Delete an existing category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('create-edit-delete-message', 'Category deleted successfully!');
        return redirect()->back();
    }
}
