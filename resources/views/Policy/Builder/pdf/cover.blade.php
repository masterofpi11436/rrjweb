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
    }

    .section-content {
        line-height: 1.2;
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
        border-collapse: collapse;
        font-size: 8pt;
    }

    .signature-table td {
        border: 1px solid #000;
        padding: 4px 6px;
        height: 34px;
    }

    .signature-label {
        width: 24%;
        font-weight: bold;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .signature-person {
        width: 24%;
        line-height: 1.2;
    }

    .signature-box {
        width: 32%;
    }

    .date-box {
        width: 20%;
        white-space: nowrap;
    }

    .date-value {
        font-weight: normal;
        padding-left: 8px;
    }
</style>

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="27%" style="vertical-align:top;">
            <img src="{{ public_path('images/rrj-logo.jpg') }}" width="120">
        </td>

        <td width="73%" style="vertical-align:top; font-size:9pt; line-height:1.2;"><strong style="font-size:14">POLICY
                TITLE:</strong><br><strong style="font-size:14">{{ $policy->title }}</strong><br><br><strong
                style="font-size:12">POLICY STATEMENT:</strong><br>{{ $policy->policy_statement }}<br><br><strong
                style="font-size:12">PURPOSE STATEMENT:</strong><br>{{ $policy->policy_purpose }}
        </td>
    </tr>
</table>

<br>

<div class="section-content"><span
        class="standard-title"><strong>STANDARDS:</strong></span>{{ $policy->standards }}<br><span
        class="standard-title">AMERICAN CORRECTIONAL
        ASSOCIATION:</span>{{ $policy->american_correctional_association }}<br><span class="standard-title">VA BOARD OF
        LOCAL AND REGIONAL JAILS:</span>{{ $policy->va_board_of_local_and_regional_jails }}<br><span
        class="standard-title">PRISON RAPE ELIMINATION
        ACT:</span>{{ $policy->prison_rape_and_elimination_act }}<br><span
        class="standard-title">NCCHC:</span>{{ $policy->ncchc }}
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
                    $index = $col * $rowsNeeded + $row;
                    $item = $dates[$index] ?? null;
                @endphp

                <td><strong>{{ $item['revision'] ?? '' }}</strong></td>
                <td>{{ isset($item['date']) ? \Carbon\Carbon::parse($item['date'])->format('m/d/y') : '' }}</td>
            @endfor

        </tr>
    @endfor
</table>

<br>

<div class="signature-title">SIGNATURES:</div>

<br>

<table class="signature-table" cellpadding="0" cellspacing="0">
    <tr>
        <td class="signature-label" valign="middle" align="left">
            <span style="font-size:9pt; line-height:34px;">POLICY OWNER:</span>
        </td>

        <td class="signature-person">
            <strong>{{ $policy->policy_owner }}</strong>
        </td>

        <td class="signature-box">&nbsp;</td>

        <td class="date-box" valign="middle" align="left">
            <span style="line-height:34px;">
                <strong>DATE:</strong>
            </span>
        </td>
    </tr>

    <tr>
        <td class="signature-label" valign="middle" align="left">
            <span style="font-size:9pt; line-height:34px;">POLICY REVIEWER:</span>
        </td>

        <td class="signature-person">
            <strong>{{ $policy->policy_reviewer }}</strong>
        </td>

        <td class="signature-box">&nbsp;</td>

        <td class="date-box" valign="middle" align="left">
            <span style="line-height:34px;">
                <strong>DATE:</strong>
            </span>
        </td>
    </tr>

    <tr>
        <td class="signature-label" valign="middle" align="left">
            <span style="font-size:9pt; line-height:34px;">SUPERINTENDENT</span>
        </td>

        <td class="signature-person">
            <strong>{{ $policy->superintendent_approval }}</strong>
        </td>

        <td class="signature-box">&nbsp;</td>

        <td class="date-box" valign="middle" align="left">
            <span style="line-height:34px;">
                <strong>DATE:</strong>
            </span>
        </td>
    </tr>
</table>
