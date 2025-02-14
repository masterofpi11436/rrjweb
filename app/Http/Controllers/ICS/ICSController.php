<?php

namespace App\Http\Controllers\ICS;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\ICS\ICS;

class ICSController extends Controller
{
    public function dashboard()
    {
        return view('ICS.ICS.dashboard');
    }
    public function create()
    {
        return view('ICS.ICS.create');
    }

    public function edit($id)
    {
        $ics = ICS::findOrFail($id);
        return view('ICS.ICS.edit', ['ics' => $ics]);
    }

    public function destroy($id)
    {
        $tablet = ICS::findOrFail($id);
        $tablet->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
