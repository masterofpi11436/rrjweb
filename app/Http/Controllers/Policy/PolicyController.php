<?php

namespace App\Http\Controllers\Policy;

// Base Controller
use App\Models\Policy\Policy;

// Models required
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function dashboard()
    {
        return view('Policy.Policy.dashboard');
    }

    public function create()
    {
        return view('Policy.Policy.upload');
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'title' => 'required|string|max:255', // Title for the policy
            'pdf' => 'required|mimes:pdf|max:3,072', // Ensure file is a PDF with max size of 3MB
        ]);

        // Handle the file upload
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $originalName = $file->getClientOriginalName(); // Get the original file name
            $filePath = $file->storeAs('policies', $originalName, 'public'); // Save with original name in 'policies' folder
        }

        // Create the policy record in the database
        Policy::create([
            'title' => $request->input('title'),
            'pdf' => $filePath, // Save the file path
        ]);

        // Redirect back with a success message
        return back()->with('create-edit-delete-message', 'PDF uploaded successfully!');
    }

    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
