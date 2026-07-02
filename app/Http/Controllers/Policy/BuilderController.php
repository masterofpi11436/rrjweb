<?php

namespace App\Http\Controllers\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy\PolicyBuilder;
use TCPDF;
use TCPDF_FONTS;

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
            'chapters.sections.paragraphs.bullets.bulletBullets',
            'references.paragraphs.bullets',
            'policyDefinitions',
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

        $fontName = TCPDF_FONTS::addTTFfont(
            public_path('fonts/CANDARAB.TTF'),
            'TrueTypeUnicode',
            '',
            96
        );

        $fontName = TCPDF_FONTS::addTTFfont(
            public_path('fonts/CANDARA.TTF'),
            'TrueTypeUnicode',
            '',
            96
        );

        $pdf->SetFont($fontName, '', 11);

        $this->writePdfPage(
            $pdf,
            $policy,
            view('Policy.Builder.pdf.cover', compact('policy'))->render(),
            $fontName,
            false
        );

        $this->writePdfPage(
            $pdf,
            $policy,
            view('Policy.Builder.pdf.toc', compact('policy'))->render(),
            $fontName,
            true
        );

        $this->writePdfPage(
            $pdf,
            $policy,
            view('Policy.Builder.pdf.body', compact('policy'))->render(),
            $fontName,
            true
        );

        if ($policy->policyDefinitions->isNotEmpty()) {
            $this->writePdfPage(
                $pdf,
                $policy,
                view('Policy.Builder.pdf.definitions', compact('policy'))->render(),
                $fontName,
                true
            );
        }

        if ($policy->references->isNotEmpty()) {
            $this->writePdfPage(
                $pdf,
                $policy,
                view('Policy.Builder.pdf.references', compact('policy'))->render(),
                $fontName,
                true
            );
        }

        return response(
            $pdf->Output(str($policy->title)->slug() . '.pdf', 'S'),
            200
        )->header('Content-Type', 'application/pdf');
    }

    private function writePdfPage(
        TCPDF $pdf,
        PolicyBuilder $policy,
        string $html,
        string $fontName,
        bool $withFooter = true
    ): void {
        $pdf->AddPage();
        $startPage = $pdf->getPage();

        $pdf->SetFont($fontName, '', 11);

        $pdf->writeHTML($html, true, false, true, false, '');

        $endPage = $pdf->getPage();

        for ($page = $startPage; $page <= $endPage; $page++) {
            $pdf->setPage($page);
            $this->addPageBorder($pdf);

            if ($withFooter) {
                $this->addPolicyFooter($pdf, $policy, $fontName);
            }
        }
    }

    private function addPageBorder(TCPDF $pdf): void
    {
        $pdf->SetDrawColor(72, 190, 135);
        $pdf->SetLineWidth(0.8);
        $pdf->Rect(8, 8, 199, 263);
    }

    private function addPolicyFooter(TCPDF $pdf, PolicyBuilder $policy, string $fontName): void
    {
        $autoPageBreak = $pdf->getAutoPageBreak();
        $breakMargin = $pdf->getBreakMargin();

        $pdf->SetAutoPageBreak(false, 0);

        $pdf->SetFont($fontName, '', 11);
        $pdf->SetXY(115, 263);

        $pdf->Cell(
            80,
            5,
            trim(($policy->policy_number ?? '') . ' ' . ($policy->title ?? '')),
            0,
            0,
            'R'
        );

        $pdf->SetAutoPageBreak($autoPageBreak, $breakMargin);
    }

    public function webView($id)
    {
        $policy = PolicyBuilder::with([
            'chapters.sections.paragraphs.bullets.bulletBullets',
            'references.paragraphs.bullets',
            'policyDefinitions',
        ])->findOrFail($id);

        return view('Policy.Builder.builder.web', [
            'policy' => $policy,
        ]);
    }
}
