<?php

namespace App\Http\Controllers\Tablet;

use Illuminate\Http\Request;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Tablet\InmateTablet;

class InmateTabletController extends Controller
{
    // Public page for viewing all tablets
    public function inmateTablets()
    {
        return view('Tablet.InmateTablet.public-dashboard');
    }

    // Login Required Pages
    public function dashboard(Request $request)
    {
        return view('Tablet.InmateTablet.dashboard');
    }

    public function create()
    {
        return view('Tablet.InmateTablet.create');
    }

    public function edit($id)
    {
        $inmateTablet = InmateTablet::findOrFail($id);

        return view('Tablet.InmateTablet.edit', ['inmateTablet' => $inmateTablet]);
    }

    public function destroy($id)
    {
        $inmateTablet = InmateTablet::findOrFail($id);
        $inmateTablet->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');

        return redirect()->back();
    }
}
