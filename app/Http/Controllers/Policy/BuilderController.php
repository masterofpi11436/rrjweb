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

        $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetCreator(config('app.name'));
        $pdf->SetAuthor('Policy Builder');
        $pdf->SetTitle($policy->title);
        $pdf->SetSubject('Policy Document');

        $pdf->SetMargins(20, 18, 20);
        $pdf->SetAutoPageBreak(true, 18);
        $pdf->SetFont('times', '', 11);

        $pdf->AddPage();
        $this->addPageBorder($pdf);
        $pdf->writeHTML(view('Policy.Builder.pdf.cover', compact('policy'))->render(), true, false, true, false, '');

        $pdf->AddPage();
        $this->addPageBorder($pdf);
        $pdf->writeHTML(view('Policy.Builder.pdf.toc', compact('policy'))->render(), true, false, true, false, '');

        $pdf->AddPage();
        $this->addPageBorder($pdf);
        $pdf->writeHTML(view('Policy.Builder.pdf.body', compact('policy'))->render(), true, false, true, false, '');

        return response(
            $pdf->Output(str($policy->title)->slug() . '.pdf', 'S'),
            200
        )->header('Content-Type', 'application/pdf');
    }

    private function addPageBorder(TCPDF $pdf): void
    {
        $pdf->SetDrawColor(72, 190, 135);
        $pdf->SetLineWidth(0.8);
        $pdf->Rect(8, 8, 199, 263);
    }


}
