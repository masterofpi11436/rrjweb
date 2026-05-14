<?php

namespace App\Http\Controllers\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy\PolicyBuilder;
use TCPDF;

class BuilderController extends Controller
{
    public function index()
    {
        return view('Policy.Builder.builder.index');
    }

    public function create()
    {
        return view('Policy.Builder.builder.create');
    }

    public function edit($id)
    {
        return view('Policy.Builder.builder.edit', [
            'policyBuilderId' => $id,
        ]);
    }

    public function destroy($id)
    {
        $policy = PolicyBuilder::findOrFail($id);

        $policy->delete();

        return redirect()
            ->route('policy.builder.index')
            ->with('success', 'Policy deleted successfully.');
    }

    public function createPDF($id)
    {
        $policy = PolicyBuilder::with([
            'chapters.sections.paragraphs.bullets'
        ])->findOrFail($id);

        $pdf = new TCPDF();

        // Document information
        $pdf->SetCreator(config('app.name'));
        $pdf->SetAuthor('Policy Builder');
        $pdf->SetTitle($policy->title);
        $pdf->SetSubject('Policy Document');

        // Margins
        $pdf->SetMargins(15, 20, 15);

        // Auto page break
        $pdf->SetAutoPageBreak(true, 20);

        // Add first page
        $pdf->AddPage();

        // Generate HTML
        $html = view('Policy.Builder.pdf.policy', [
            'policy' => $policy,
        ])->render();

        // Write HTML into PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Download / stream PDF
        return response(
            $pdf->Output(
                str($policy->title)->slug() . '.pdf',
                'S'
            ),
            200
        )->header('Content-Type', 'application/pdf');
    }
}
