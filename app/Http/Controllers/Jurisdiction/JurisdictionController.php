<?php

namespace App\Http\Controllers\Jurisdiction;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Jurisdiction\Jurisdiction;
use App\Models\Jurisdiction\JurisdictionTimeLog;

class JurisdictionController extends Controller
{
    public function dashboard()
    {
        return view('Jurisdiction.jurisdiction.dashboard');
    }

    // CRUD for Jurisdictions
    public function create()
    {
        return view('Jurisdiction.jurisdiction.create');
    }

    public function edit($id)
    {
        $jurisdiction = Jurisdiction::findOrFail($id);
        return view('Jurisdiction.jurisdiction.edit', ['jurisdiction' => $jurisdiction]);
    }

    public function destroy($id)
    {
        $jurisdiction = Jurisdiction::findOrFail($id);
        $jurisdiction->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }

    // CRUD for Jurisdiction Time Logs
    public function createTimeLog()
    {
        return view('Jurisdiction.jurisdiction.create');
    }

    public function editTimeLog($id)
    {
        $jurisdiction = Jurisdiction::findOrFail($id);
        return view('Jurisdiction.jurisdiction.edit', ['jurisdiction' => $jurisdiction]);
    }

    public function destroyTimeLog($id)
    {
        $jurisdiction = Jurisdiction::findOrFail($id);
        $jurisdiction->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
