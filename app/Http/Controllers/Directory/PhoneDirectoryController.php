<?php

namespace App\Http\Controllers\Directory;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Directory\PhoneDirectory;

class PhoneDirectoryController extends Controller
{
    // Unprotected route for everyone to view the directory
    public function phoneDirectory()
    {
        return view('Directory.PhoneDirectory.phone-directory');
    }

    // Login Required Pages
    public function dashboard()
    {
        return view('Directory.PhoneDirectory.dashboard');
    }

    public function create()
    {
        return view('Directory.PhoneDirectory.create');
    }

    public function edit($id)
    {
        $phoneDirectory = PhoneDirectory::findOrFail($id);
        return view('Directory.PhoneDirectory.edit', ['phoneDirectory' => $phoneDirectory]);
    }

    public function destroy($id)
    {
        $phoneDirectory = PhoneDirectory::findOrFail($id);
        $phoneDirectory->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
