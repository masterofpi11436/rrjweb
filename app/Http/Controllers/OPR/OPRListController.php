<?php

namespace App\Http\Controllers\OPR;

// Base Controller
use App\Http\Controllers\Controller;

//Required Models
use App\Models\OPR\OPRList;

class OPRListController extends Controller
{
    public function mailingList()
    {
        return view('OPR.OPRList.mailing-list');
    }

    // Login Required Pages
    public function dashboard()
    {
        return view('OPR.OPRList.dashboard');
    }

    public function create()
    {
        return view('OPR.OPRList.create');
    }

    public function edit($id)
    {
        $oprListId = OPRList::findOrFail($id);

        return view('OPR.OPRList.edit', ['oprListId' => $oprListId]);
    }

    public function destroy($id)
    {
        $oprList = OPRList::findOrFail($id);
        $oprList->delete();

        session()->flash('create-edit-delete-message', 'Inmate has been deleted!');

        return redirect()->back();
    }
}
