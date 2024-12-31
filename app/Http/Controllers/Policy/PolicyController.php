<?php

namespace App\Http\Controllers\Policy;

// Base Controller
use Illuminate\Http\Request;

// Models required
use Smalot\PdfParser\Parser;
use App\Models\Policy\Policy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            'pdf' => 'required|mimes:pdf|max:30720', // Ensure file is a PDF with max size of 30MB
        ]);

        // Handle the file upload
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $originalName = $file->getClientOriginalName(); // Get the original file name
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $pdfFilePath = $file->storeAs('policies', $originalName, 'public'); // Save with original name in 'policies' folder

            // Extract text from the uploaded PDF
            $parser = new Parser();
            $pdf = $parser->parseFile(storage_path('app/public/' . $pdfFilePath));
            $extractedText = $pdf->getText();

            // Save extracted text to a .txt file
            $textFileName = $baseName . ".txt";
            $textFilePath = 'policies/text/' . $textFileName;
            Storage::disk('public')->put($textFilePath, $extractedText);

            // Create the policy record in the database
            Policy::create([
                'title' => $originalName,
                'pdf' => $pdfFilePath,
                'text' => $textFilePath,
            ]);

            // Redirect back with a success message
            return redirect()->route('policy.dashboard')->with('create-edit-delete-message', 'PDF uploaded and text extracted successfully!');
        }

        // Handle the case where the file was not uploaded
        return redirect()->route('policy.dashboard')->withErrors('Failed to upload the PDF.');
    }

    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
