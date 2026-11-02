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
        // Allow additional processing time for large PDFs
        set_time_limit(600);
        ini_set('memory_limit', '1024M');

        $request->validate([
            'pdfs' => 'required|array',
            'pdfs.*' => 'required|file|mimes:pdf|max:153600',
        ]);

        if ($request->hasFile('pdfs')) {

            foreach ($request->file('pdfs') as $file) {

                $originalName = $file->getClientOriginalName();
                $baseName = pathinfo($originalName, PATHINFO_FILENAME);

                $pdfFilePath = $file->storeAs(
                    'policies',
                    $originalName,
                    'public'
                );

                try {

                    // Extract text from the uploaded PDF
                    $parser = new Parser();

                    $pdf = $parser->parseFile(
                        Storage::disk('public')->path($pdfFilePath)
                    );

                    $extractedText = $pdf->getText();

                    // Check for image-based PDFs
                    if (strlen(trim($extractedText)) < 50) {

                        Storage::disk('public')->delete($pdfFilePath);

                        return redirect()
                            ->route('policy.upload')
                            ->with(
                                'create-edit-delete-message',
                                "{$originalName} is an image-based PDF. Please upload a searchable PDF."
                            );
                    }

                    // Save extracted text
                    $textFilePath = 'policies/text/' . $baseName . '.txt';

                    Storage::disk('public')->put(
                        $textFilePath,
                        $extractedText
                    );

                    // Create policy record
                    Policy::create([
                        'title' => $baseName,
                        'pdf' => $pdfFilePath,
                        'text' => $textFilePath,
                    ]);

                } catch (\Throwable $e) {

                    return redirect()
                        ->route('policy.upload')
                        ->withErrors([
                            'pdfs' => "Failed to process {$originalName}."
                        ]);
                }
            }

            return redirect()
                ->route('policy.dashboard')
                ->with(
                    'create-edit-delete-message',
                    'PDFs uploaded and text extracted successfully!'
                );
        }

        return redirect()
            ->route('policy.dashboard')
            ->withErrors('Failed to upload the PDFs.');
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
