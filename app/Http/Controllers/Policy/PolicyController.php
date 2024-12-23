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

    public function upload(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'title' => 'required|string|max:255', // Title for the policy
            'pdf' => 'required|mimes:pdf|max:2048', // Ensure file is a PDF with max size of 2MB
        ]);

        // Sanitize the file name
        $file = $request->file('pdf');
        $sanitizedName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

        // Store the PDF in the 'public/policy-pdf' directory
        $filePath = $file->storeAs('policy-pdf', $sanitizedName);

        // Save policy information to the database
        Policy::create([
            'title' => $request->title, // Save the title from the form
            'pdf_path' => $filePath, // Save the file path
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
