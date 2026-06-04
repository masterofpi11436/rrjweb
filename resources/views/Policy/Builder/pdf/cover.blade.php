{{-- resources/views/Policy/Builder/pdf/cover.blade.php --}}

<style>
    @page {
        margin: 20px;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 8.5pt;
        line-height: 1.1;
        color: #000;
        margin: 0;
    }

    .page-border {
        border: 2px solid #4cc46b;
        padding: 14px;
    }

    table {
        border-collapse: collapse;
    }

    .section-title {
        font-weight: bold;
        text-transform: uppercase;
        line-height: 1.1;
    }

    .section-content {
        line-height: 1.2;
        margin-bottom: 2px;
    }

    .policy-title {
        font-weight: bold;
        font-size: 14pt;
    }

    .standard-title {
        font-weight: bold;
        text-transform: uppercase;
        font-size: 9pt;
    }

    .revision-table {
        margin-top: 8px;
        font-size: 9pt;
    }

    .revision-table td {
        border: 1px solid #74c98b;
        padding: 3px 5px;
        height: 17px;
    }

    .revision-header td {
        background-color: #36b34a;
        color: #fff;
        font-weight: bold;
    }

    .revision-data-row-even td {
        background-color: #97eea6;
    }

    .revision-data-row-odd td {
        background-color: #ffffff;
    }

    .signature-title {
        margin-top: 12px;
        margin-bottom: 5px;
        font-size: 8pt;
        font-weight: bold;
        text-transform: uppercase;
    }

    .signature-table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
        font-size: 8pt;
    }

    .signature-table td {
        border: 1px solid #444;
        padding: 4px 5px;
        height: 32px;
        overflow: hidden;
    }

    .signature-label {
        width: 25%;
        font-weight: bold;
        text-transform: uppercase;
    }

    .signature-person {
        width: 25%;
    }

    .signature-box {
        width: 30%;
    }

    .date-box {
        width: 20%;
        font-weight: bold;
        white-space: nowrap;
    }

    .date-value {
        font-weight: normal;
    }
</style>

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="27%" style="vertical-align:top;">
            <img src="{{ public_path('images/rrj-logo.jpg') }}" width="120">
        </td>

        <td width="73%" style="vertical-align:top; font-size:9pt; line-height:1.2;"><strong>POLICY TITLE:</strong><br><strong>{{ $policy->title }}</strong><br><br><strong>POLICY STATEMENT:</strong><br>{{ $policy->policy_statement }}<br><br><strong>PURPOSE STATEMENT:</strong><br>{{ $policy->policy_purpose }}
        </td>
    </tr>
</table>

<br>

<div class="section-content">
<span class="standard-title">STANDARDS:</span>
{{ $policy->standards }}<br>

<span class="standard-title">AMERICAN CORRECTIONAL ASSOCIATION:</span>
{{ $policy->american_correctional_association }}<br>

<span class="standard-title">VA BOARD OF LOCAL AND REGIONAL JAILS:</span>
{{ $policy->va_board_of_local_and_regional_jails }}<br>

<span class="standard-title">PRISON RAPE ELIMINATION ACT:</span>
{{ $policy->prison_rape_and_elimination_act }}<br>

<span class="standard-title">NCCHC:</span>
{{ $policy->ncchc }}
</div>

<br>

<span class="section-title">POLICY CROSS REFERENCE:</span>
<div class="section-content">{{ $policy->policy_cross_reference }}</div><br>

<span class="section-title">FORMS:</span>
<div class="section-content">{{ $policy->forms }}</div><br>

<span class="section-title">POLICY EFFECTIVE DATE:</span>
<div class="section-content">{{ \Carbon\Carbon::parse($policy->policy_effective_date)->format('m/d/y') }}</div>

<div class="section-title">POLICY REVIEW / REVISION DATE:</div>

<br>

<table class="revision-table">
    <tr class="revision-header">
        @for ($i = 0; $i < 4; $i++)
            <td>Revision:</td>
            <td>Date:</td>
        @endfor
    </tr>

    @php
        $dates = $policy->policy_revision_dates ?? [];

        $columns = 4;
        $rowsNeeded = 7;
    @endphp

    @for ($row = 0; $row < $rowsNeeded; $row++)
        <tr class="{{ $row % 2 === 0 ? 'revision-data-row-even' : 'revision-data-row-odd' }}">

            @for ($col = 0; $col < $columns; $col++)
                @php
                    $index = ($col * $rowsNeeded) + $row;
                    $item = $dates[$index] ?? null;
                @endphp

                <td>{{ $item['revision'] ?? '' }}</td>
                <td>{{ isset($item['date']) ? \Carbon\Carbon::parse($item['date'])->format('m/d/y') : '' }}</td>

            @endfor

        </tr>
    @endfor
</table>

<br>

<div class="signature-title">SIGNATURES:</div>

<br>

<table class="signature-table">
    <tr>
        <td class="signature-label">POLICY OWNER:</td>
        <td class="signature-person">
            <div class="signature-name">{{ $policy->policy_owner }}</div>
            <div class="signature-position">{{ $policy->policy_owner_title }}</div>
        </td>
        <td class="signature-box">&nbsp;</td>
        <td class="date-box">
            DATE:
            <span class="date-value">{{ $policy->policy_owner_date }}</span>
        </td>
    </tr>

    <tr>
        <td class="signature-label">POLICY REVIEWER:</td>
        <td class="signature-person">
            <div class="signature-name">{{ $policy->policy_reviewer }}</div>
            <div class="signature-position">{{ $policy->policy_reviewer_title }}</div>
        </td>
        <td class="signature-box">&nbsp;</td>
        <td class="date-box">
            DATE:
            <span class="date-value">{{ $policy->policy_reviewer_date }}</span>
        </td>
    </tr>

    <tr>
        <td class="signature-label">SUPERINTENDENT APPROVAL:</td>
        <td class="signature-person">
            <div class="signature-name">{{ $policy->superintendent_approval }}</div>
            <div class="signature-position"></div>
        </td>
        <td class="signature-box">&nbsp;</td>
        <td class="date-box">
            DATE:
            <span class="date-value">{{ $policy->superintendent_approval_date }}</span>
        </td>
    </tr>
</table>


