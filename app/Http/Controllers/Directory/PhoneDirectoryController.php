<?php

namespace App\Http\Controllers\Directory;

use Illuminate\Http\Request;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Directory\PhoneDirectory;

class PhoneDirectoryController extends Controller
{

    // Unprotected route for everyone to view directory and search entries
    public function indexAll(Request $request)
    {
        $extensions = $this->searchDirectory($request);

        return view('Directory.PhoneDirectory.indexAll', [
            'extensions' => $extensions,
            'search' => $request->input('search'),
        ]);
    }

    public function index(Request $request)
    {
        $extensions = $this->searchDirectory($request);

        return view('Directory.PhoneDirectory.index', [
            'extensions' => $extensions,
            'search' => $request->input('search'),
        ]);
    }

    private function searchDirectory (Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $extensions = PhoneDirectory::where('name', 'like', '%' . $search . '%')
                                        ->orWhere('title', 'like', '%' . $search . '%')
                                        ->orWhere('section', 'like', '%' . $search . '%')
                                        ->orWhere('extension', 'like', '%' . $search . '%')
                                        ->orderBy('section')
                                        ->get();
        }

        return PhoneDirectory::orderBy('section')->get();
    }
    
    public function create()
    {
        return view('Directory.PhoneDirectory.create');
    }

    public function edit($id)
    {
        // Retrieve the record by its ID
        $phoneDirectory = PhoneDirectory::findOrFail($id);

        // Pass the retrieved record to the Blade view
        return view('Directory.PhoneDirectory.edit', ['phoneDirectory' => $phoneDirectory]);
    }

    public function destroy($id)
    {
        // Find the record and delete it
        $phoneDirectory = PhoneDirectory::findOrFail($id);
        $phoneDirectory->delete();

        // Flash message for successful deletion
        session()->flash('create-edit-delete-message', 'Record deleted successfully!');

        // Redirect to the same page or wherever needed
        return redirect()->back();
    }
}