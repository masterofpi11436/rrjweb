<?php

namespace App\Http\Controllers\Tablet;

use Illuminate\Http\Request;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Tablet\InmateTablet;

class InmateTabletController extends Controller
{
    public function dashboard(Request $request)
    {
        $tablets = $request->input('search');

        if ($tablets) {
            $tablets = InmateTablet::where('last_name', 'like', '%' . $search . '%')
                                    ->orWhere('first_name', 'like', '%' . $search . '%')
                                    ->orWhere('inmate_number', 'like', '%' . $search . '%')
                                    ->orderBy('created_at')
                                    ->get();
        }
        return view('Tablet.InmateTablet.index', ['tablets' => $tablets,
                                                  'search' => $request->input('search')]);
    }

    public function create()
    {
        return view('Tablet.InmateTablet.create');
    }

    public function edit($id)
    {
        // Retrieve the record by its ID
        $inmateTablet = InmateTablet::findOrFail($id);

        // Pass the retrieved record to the Blade view
        return view('Tablet.InmateTablet.edit', ['inmateTablet' => $inmateTablet]);
    }

    public function destroy($id)
    {
        // Find the record and delete it
        $inmateTablet = InmateTablet::findOrFail($id);
        $inmateTablet->delete();

        // Flash message for successful deletion
        session()->flash('create-edit-delete-message', 'Record deleted successfully!');

        // Redirect to the same page or wherever needed
        return redirect()->back();
    }
}
