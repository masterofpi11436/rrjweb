<?php

namespace App\Http\Controllers\VFM;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\VFM\VFM30;

class VFM30Controller extends Controller
{
    public function dashboard()
    {
        return view('VFM.VFM.dashboard');
    }

    public function create()
    {
        return view('VFM.VFM.create');
    }

    public function edit($id)
    {
        $vfm = VFM30::findOrFail($id);
        return view('VFM.VFM.edit', ['vfm' => $vfm]);
    }

    public function destroy($id)
    {
        $vfm = VFM30::findOrFail($id);
        $vfm->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
