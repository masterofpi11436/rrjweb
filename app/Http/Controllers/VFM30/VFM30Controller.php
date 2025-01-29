<?php

namespace App\Http\Controllers\VFM30;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\VFM30\VFM30;

class VFM30Controller extends Controller
{
    public function dashboard()
    {
        return view('VFM30.VFM30.dashboard');
    }

    public function create()
    {
        return view('VFM30.VFM30.create');
    }

    public function edit($id)
    {
        $vfm = VFM30::findOrFail($id);
        return view('VFM30.VFM30.edit', ['vfm' => $vfm]);
    }

    public function destroy($id)
    {
        $vfm = VFM30::findOrFail($id);
        $vfm->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
