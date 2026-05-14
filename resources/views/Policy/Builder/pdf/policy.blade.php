<style>
    body {
        font-family: helvetica;
        font-size: 11px;
        color: #000;
    }

    h1 {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 14px;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 8px;
    }

    h3 {
        font-size: 12px;
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 6px;
    }

    p {
        line-height: 1.5;
    }

    .label {
        font-weight: bold;
        width: 230px;
    }

    .section-table {
        width: 100%;
        border-collapse: collapse;
    }

    .section-table td {
        padding: 5px;
        vertical-align: top;
    }

    .spacer {
        height: 20px;
    }

    .signature-line {
        border-bottom: 1px solid #000;
        height: 25px;
    }

    .page-break {
        page-break-after: always;
    }

    ul, ol {
        margin-left: 20px;
    }
</style>

<h1>POLICY TITLE: {{ $policy->title }}</h1>

<table class="section-table">
    <tr>
        <td class="label">POLICY STATEMENT:</td>
        <td>{{ $policy->policy_statement }}</td>
    </tr>

    <tr>
        <td class="label">PURPOSE STATEMENT:</td>
        <td>{{ $policy->policy_purpose }}</td>
    </tr>

    <tr><td colspan="2" class="spacer"></td></tr>

    <tr>
        <td class="label">STANDARDS:</td>
        <td>{{ $policy->standards }}</td>
    </tr>

    <tr>
        <td class="label">AMERICAN CORRECTIONAL ASSOCIATION:</td>
        <td>{{ $policy->american_correctional_association }}</td>
    </tr>

    <tr>
        <td class="label">VA BOARD OF LOCAL AND REGIONAL JAILS:</td>
        <td>{{ $policy->va_board_of_local_and_regional_jails }}</td>
    </tr>

    <tr>
        <td class="label">PRISON RAPE ELIMINATION ACT:</td>
        <td>{{ $policy->prison_rape_and_elimination_act }}</td>
    </tr>

    <tr>
        <td class="label">NCCHC:</td>
        <td>{{ $policy->ncchc }}</td>
    </tr>

    <tr><td colspan="2" class="spacer"></td></tr>

    <tr>
        <td class="label">POLICY CROSS REFERENCE:</td>
        <td>{{ $policy->policy_cross_reference }}</td>
    </tr>

    <tr>
        <td class="label">FORMS:</td>
        <td>{{ $policy->forms }}</td>
    </tr>

    <tr>
        <td class="label">POLICY EFFECTIVE DATE:</td>
        <td>{{ $policy->policy_effective_date }}</td>
    </tr>
</table>

<h2>POLICY REVIEW / REVISION DATE:</h2>

<table class="section-table">
    @forelse($policy->policy_revision_dates ?? [] as $revision)
        <tr>
            <td class="label">Revision:</td>
            <td>{{ $revision['revision'] ?? '' }}</td>
            <td class="label">Date:</td>
            <td>{{ $revision['date'] ?? '' }}</td>
        </tr>
    @empty
        <tr>
            <td class="label">Revision:</td>
            <td></td>
            <td class="label">Date:</td>
            <td></td>
        </tr>
    @endforelse
</table>

<div class="spacer"></div>

<h2>SIGNATURES:</h2>

<table class="section-table">
    <tr>
        <td class="label">POLICY OWNER:</td>
        <td class="signature-line"></td>
        <td class="label">DATE:</td>
        <td class="signature-line">{{ $policy->policy_owner_date }}</td>
    </tr>

    <tr>
        <td class="label">POLICY REVIEWER:</td>
        <td class="signature-line"></td>
        <td class="label">DATE:</td>
        <td class="signature-line">{{ $policy->policy_reviewer_date }}</td>
    </tr>

    <tr>
        <td class="label">SUPERINTENDENT APPROVAL:</td>
        <td class="signature-line"></td>
        <td class="label">DATE:</td>
        <td class="signature-line">{{ $policy->superintendent_approval_date }}</td>
    </tr>
</table>

<div class="page-break"></div>

<h1>Table of Contents</h1>

<p>{{ $policy->table_of_contents }}</p>

<div class="page-break"></div>

@foreach($policy->chapters as $chapter)
    <h2>{{ $chapter->chapter_title }}</h2>

    @foreach($chapter->sections as $section)
        <h3>{{ $section->section_title }}</h3>

        @foreach($section->paragraphs as $paragraph)
            <p>{{ $paragraph->paragraph }}</p>

            @php
                $orderedBullets = $paragraph->bullets->where('type', 'ordered');
                $regularBullets = $paragraph->bullets->where('type', 'bullet');
            @endphp

            @if($regularBullets->count())
                <ul>
                    @foreach($regularBullets as $bullet)
                        <li>{{ $bullet->list['text'] ?? '' }}</li>
                    @endforeach
                </ul>
            @endif

            @if($orderedBullets->count())
                <ol>
                    @foreach($orderedBullets as $bullet)
                        <li>{{ $bullet->list['text'] ?? '' }}</li>
                    @endforeach
                </ol>
            @endif
        @endforeach
    @endforeach
@endforeach

@if($policy->references)
    <h2>REFERENCES:</h2>
    <p>{{ $policy->references }}</p>
@endif

@if($policy->definitions)
    <h2>DEFINITIONS:</h2>
    <p>{{ $policy->definitions }}</p>
@endif
