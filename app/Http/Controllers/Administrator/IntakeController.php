<?php

namespace App\Http\Controllers\Administrator;

// Base Controller
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Http\Controllers\Controller;

class IntakeController extends Controller
{
    // Display the user dashboard for IT administrator(s)
    public function index()
    {
        return view('Administrator.Intakes.index');
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'pdf' => ['required', 'file', 'mimes:pdf', 'max:10240'], // 10 MB
        ]);

        $file = $validated['pdf'];

        // Parse PDF
        $parser = new Parser();
        $pdf = $parser->parseFile($file->getRealPath());
        $text = $pdf->getText() ?? '';
        $year = date('y');
        $year = date('y'); // "25" in 2025
        preg_match_all('/' . $year . '-\d+/', $text, $matches);
        $matches = array_values(array_unique($matches[0] ?? []));

        // Show results back on the same page
        return view('Administrator.Intakes.index', [
            'matches' => $matches,
            'count'   => count($matches),
        ]);
    }
}
