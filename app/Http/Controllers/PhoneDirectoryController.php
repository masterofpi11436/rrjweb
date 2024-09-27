<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models required
use App\Models\PhoneDirectory;

class PhoneDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $extensions = PhoneDirectory::where('name', 'like', '%' . $search . '%')
                                        ->orWhere('title', 'like', '%' . $search . '%')
                                        ->orWhere('section', 'like', '%' . $search . '%')
                                        ->orWhere('extension', 'like', '%' . $search . '%')
                                        ->orderBy('section')
                                        ->get();
        } else {
            $extensions = PhoneDirectory::orderBy('section')->get();
        }

        return view('PhoneDirectory.index', ['extensions' => $extensions, 'search' => $search]);
    }
    
    public function create()
    {
        // This will load the create Blade view
        return view('PhoneDirectory.create');
    }

    public function edit($id)
    {
        // Retrieve the record by its ID
        $phoneDirectory = PhoneDirectory::findOrFail($id);

        // Pass the retrieved record to the Blade view
        return view('PhoneDirectory.edit', ['phoneDirectory' => $phoneDirectory]);
    }

}
