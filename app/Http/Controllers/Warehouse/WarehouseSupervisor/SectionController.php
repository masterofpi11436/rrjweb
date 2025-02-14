<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Warehouse\Section;

// CRUD operations for sections.
class SectionController extends Controller
{
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
