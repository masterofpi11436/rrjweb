<style>
    body {
        font-family: times;
        font-size: 11pt;
        color: #000;
    }

    .title-label {
        text-transform: uppercase;
        font-weight: bold;
        margin-bottom: 24px;
    }

    .label {
        text-transform: uppercase;
        font-weight: bold;
        width: 240px;
        vertical-align: top;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 3px 4px;
        vertical-align: top;
    }

    .big-space {
        height: 28px;
    }

    .revision-table td {
        height: 28px;
    }

    .signature-table td {
        height: 34px;
    }

    .signature-line {
        border-bottom: 1px solid #000;
    }

    .page-break {
        page-break-after: always;
    }

    .toc-title {
        text-align: center;
        font-size: 14pt;
        font-weight: bold;
        margin-top: 40px;
    }
    .page-break {
        page-break-after: always;
    }

    h2 {
        font-size: 12pt;
        font-weight: bold;
        margin-top: 18px;
        margin-bottom: 8px;
    }

    h3 {
        font-size: 11pt;
        font-weight: bold;
        margin-top: 12px;
        margin-bottom: 6px;
    }

    p {
        line-height: 1.5;
        margin-bottom: 8px;
    }

    ul, ol {
        margin-left: 25px;
    }
</style>

<div class="title-label">
    POLICY TITLE:<br>
    {{ $policy->title }}
</div>

<table>
    <tr>
        <td class="label">POLICY STATEMENT:</td>
        <td>{{ $policy->policy_statement }}</td>
    </tr>
    <tr><td colspan="2" class="big-space"></td></tr>

    <tr>
        <td class="label">PURPOSE STATEMENT:</td>
        <td>{{ $policy->policy_purpose }}</td>
    </tr>
    <tr><td colspan="2" class="big-space"></td></tr>

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

    <tr><td colspan="2" class="big-space"></td></tr>

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

<br><br>

<div class="label">POLICY REVIEW /REVISION DATE:</div>

<table class="revision-table">
    @for($i = 0; $i < 4; $i++)
        <tr>
            <td class="label">Revision:</td>
            <td>{{ $policy->policy_revision_dates[$i]['revision'] ?? '' }}</td>
            <td class="label">Date:</td>
            <td>{{ $policy->policy_revision_dates[$i]['date'] ?? '' }}</td>
        </tr>
    @endfor
</table>

<br><br>

<div class="label">SIGNATURES:</div>

<table class="signature-table">
    <tr>
        <td class="label">POLICY OWNER:</td>
        <td class="signature-line"></td>
        <td class="label">DATE:</td>
        <td class="signature-line"></td>
    </tr>
    <tr>
        <td class="label">POLICY REVIEWER:</td>
        <td class="signature-line"></td>
        <td class="label">DATE:</td>
        <td class="signature-line"></td>
    </tr>
    <tr>
        <td class="label">SUPERINTENDENT APPROVAL:</td>
        <td class="signature-line"></td>
        <td class="label">DATE:</td>
        <td class="signature-line"></td>
    </tr>
</table>

<div class="page-break"></div>

<div class="toc-title">Table of Contents</div>

@foreach($policy->chapters as $chapter)
    <p>{{ $chapter->chapter_title }}</p>
@endforeach

<div class="page-break"></div>

@foreach($policy->chapters as $chapter)
    <h2>{{ $chapter->chapter_title }}</h2>

    @foreach($chapter->sections as $section)
        <h3>{{ $section->section_title }}</h3>

        @foreach($section->paragraphs as $paragraph)
            <p>{{ $paragraph->paragraph }}</p>

            @php
                $regularBullets = $paragraph->bullets->where('type', 'bullet');
                $orderedBullets = $paragraph->bullets->where('type', 'ordered');
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
