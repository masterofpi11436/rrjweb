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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phoneDirectory = PhoneDirectory::findOrFail($id);
        return view('PhoneDirectory.edit', compact('phoneDirectory'));
    }
}
