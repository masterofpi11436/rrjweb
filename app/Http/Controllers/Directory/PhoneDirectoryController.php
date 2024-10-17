<?php

namespace App\Http\Controllers\Directory;

use Illuminate\Http\Request;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Directory\PhoneDirectory;

class PhoneDirectoryController extends Controller
{
    // Unprotected route for everyone to view the directory
    public function indexAll()
    {
        return view('Directory.PhoneDirectory.indexAll');
    }

    // Dashboard for the Phone Directory manager
    public function dashboard()
    {
        return view('Directory.PhoneDirectory.dashboard');
    }

    // Create new entry
    public function create()
    {
        return view('Directory.PhoneDirectory.create');
    }

    // Edit existing entry
    public function edit($id)
    {
        $phoneDirectory = PhoneDirectory::findOrFail($id);
        return view('Directory.PhoneDirectory.edit', ['phoneDirectory' => $phoneDirectory]);
    }

    // Delete entry
    public function destroy($id)
    {
        $phoneDirectory = PhoneDirectory::findOrFail($id);
        $phoneDirectory->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
