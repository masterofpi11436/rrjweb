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
    // PUblic Pages
    public function policySearch()
    {
        return view('Policy.Policy.public-dashboard');
    }

    // Admin Pages
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
            'pdfs.*' => 'required|mimes:pdf',
        ]);

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $originalName = $file->getClientOriginalName();
                $baseName = pathinfo($originalName, PATHINFO_FILENAME);
                $pdfFilePath = $file->storeAs('policies', $originalName, 'public');

                // Extract text from the uploaded PDF
                $parser = new Parser();
                $pdf = $parser->parseFile(storage_path('app/public/' . $pdfFilePath));
                $extractedText = $pdf->getText();

                // Check for image based PDFs
                if (strlen(trim($extractedText)) < 50) {
                    Storage::disk('public')->delete($pdfFilePath);
                    return redirect()->route('policy.upload')->with('create-edit-delete-message', "{$originalName} is an image-based PDF. Please upload a searchable (text-based) PDF.");
                }

                // Save extracted text to a .txt file
                $textFilePath = 'policies/text/' . $baseName . '.txt';
                Storage::disk('public')->put($textFilePath, $extractedText);

                // Create the policy record in the database
                Policy::create([
                    'title' => $baseName, // Use the PDF file name (without extension) as the title
                    'pdf' => $pdfFilePath, // Path to the uploaded PDF
                    'text' => $textFilePath, // Path to the generated text file
                ]);
            }

            return redirect()->route('policy.dashboard')->with('create-edit-delete-message', 'PDFs uploaded and text extracted successfully!');
        }

        // Handle the case where no files were uploaded
        return redirect()->route('policy.dashboard')->withErrors('Failed to upload the PDFs.');
    }

    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);

        // Delete the associated PDF file
        if (Storage::disk('public')->exists($policy->pdf)) {
            Storage::disk('public')->delete($policy->pdf);
        }

        // Delete the associated text file
        if (Storage::disk('public')->exists($policy->text)) {
            Storage::disk('public')->delete($policy->text);
        }

        // Delete the database entry
        $policy->delete();

        session()->flash('create-edit-delete-message', 'Record and associated files deleted successfully!');
        return redirect()->back();
    }
}
