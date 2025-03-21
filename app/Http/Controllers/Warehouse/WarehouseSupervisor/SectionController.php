<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

// CRUD operations for sections.
class SectionController extends Controller
{
    protected $pendingOrdersCount;

    public function __construct()
    {
        // Make pending orders count available to all views
        $this->pendingOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))->count();
        View::share('pendingOrdersCount', $this->pendingOrdersCount);
    }

    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.Section.section.dashboard');
    }

    // Create new entry
    public function create()
    {
        return view('Warehouse.WarehouseSupervisor.Section.section.create');
    }

    // Display the form to edit an existing section
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('Warehouse.WarehouseSupervisor.Section.section.edit', ['section' => $section]);
    }

    // Delete an existing section
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        session()->flash('create-edit-delete-message', 'Section deleted successfully!');
        return redirect()->back();
    }
}
