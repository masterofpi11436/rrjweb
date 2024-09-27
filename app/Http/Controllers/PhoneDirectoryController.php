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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
