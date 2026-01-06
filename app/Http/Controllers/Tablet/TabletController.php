<?php

namespace App\Http\Controllers\Tablet;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Tablet\Tablet;

class TabletController extends Controller
{
    public function dashboard()
    {
        return view('Tablet.Tablet.dashboard');
    }
    public function create()
    {
        return view('Tablet.Tablet.create');
    }

    public function edit($id)
    {
        $tablet = Tablet::findOrFail($id);
        return view('Tablet.Tablet.edit', ['tablet' => $tablet]);
    }

    public function destroy($id)
    {
        $tablet = Tablet::findOrFail($id);
        $tablet->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
