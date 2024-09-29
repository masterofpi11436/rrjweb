<?php

namespace App\Http\Controllers\Directory;

use Illuminate\Http\Request;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Directory\PhoneDirectory;

class PhoneDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $extensions = $this->searchDirectory($request);

        return view('Directory.PhoneDirectory.index', [
            'extensions' => $extensions,
            'search' => $request->input('search'),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexAll(Request $request)
    {
        $extensions = $this->searchDirectory($request);

        return view('Directory.PhoneDirectory.indexAll', [
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
}