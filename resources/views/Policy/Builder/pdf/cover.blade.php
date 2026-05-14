{{-- resources/views/Policy/Builder/pdf/cover.blade.php --}}

<style>
    body {
        font-family: times;
        font-size: 11pt;
        color: #000;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        vertical-align: top;
    }

    .logo-cell {
        width: 170px;
    }

    .content-cell {
        padding-left: 10px;
    }

    .logo {
        width: 140px;
    }

    .section-title {
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 10px;
        margin-bottom: 3px;
    }

    .section-content {
        margin-bottom: 12px;
        line-height: 1.5;
    }

.revision-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
        font-size: 10pt;
    }

    .revision-table td {
        border: 1px solid #6fbf5f;
        padding: 4px 6px;
        height: 18px;
    }

    .revision-header td {
        background-color: #63b946;
        color: #fff;
        font-weight: bold;
    }

    .revision-data-row td {
        background-color: #dfead7;
        font-weight: bold;
    }

    .signature-title {
        margin-top: 18px;
        margin-bottom: 6px;
        font-size: 10pt;
        font-weight: bold;
        text-transform: uppercase;
    }

    .signature-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10pt;
    }

    .signature-table td {
        border: 1px solid #444;
        padding: 8px;
        vertical-align: top;
    }

    .signature-label {
        width: 170px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .signature-person {
        width: 260px;
    }

    .signature-name {
        font-weight: normal;
        font-size: 11pt;
    }

    .signature-position {
        font-size: 9pt;
        text-transform: uppercase;
    }

    .signature-box {
        width: 220px;
    }

    .date-box {
        width: 120px;
        white-space: nowrap;
        font-weight: bold;
    }

    .date-value {
        margin-left: 8px;
        font-weight: normal;
    }
</style>

<table>
    <tr>
        <td class="logo-cell">
            <img
                src="{{ public_path('images/rrja-logo.png') }}"
                class="logo"
            >
        </td>

        <td class="content-cell">

            <div class="section-title">
                POLICY TITLE:
            </div>

            <div class="section-content">
                {{ $policy->policy_number }}
                {{ $policy->title }}
            </div>

            <div class="section-title">
                POLICY STATEMENT:
            </div>

            <div class="section-content">
                {{ $policy->policy_statement }}
            </div>

            <div class="section-title">
                PURPOSE STATEMENT:
            </div>

            <div class="section-content">
                {{ $policy->policy_purpose }}
            </div>

        </td>
    </tr>
</table>

<div class="section-title">
    STANDARDS:
</div>

<div class="section-content">
    <strong>AMERICAN CORRECTIONAL ASSOCIATION:</strong>
    {{ $policy->american_correctional_association }}
    <br>

    <strong>VA BOARD OF LOCAL AND REGIONAL JAILS:</strong>
    {{ $policy->va_board_of_local_and_regional_jails }}
    <br>

    <strong>PRISON RAPE ELIMINATION ACT:</strong>
    {{ $policy->prison_rape_and_elimination_act }}
    <br>

    <strong>NCCHC:</strong>
    {{ $policy->ncchc }}
</div>

<div class="section-title">
    POLICY CROSS REFERENCE:
</div>

<div class="section-content">
    {{ $policy->policy_cross_reference }}
</div>

<div class="section-title">
    FORMS:
</div>

<div class="section-content">
    {{ $policy->forms }}
</div>

<div class="section-title">
    POLICY EFFECTIVE DATE:
</div>

<div class="section-content">
    {{ $policy->policy_effective_date }}
</div>

<div class="section-title">
    POLICY REVIEW / REVISION DATE:
</div>

<table class="revision-table">

    <tr class="revision-header">
        <td>Revision:</td>
        <td>Date:</td>

        <td>Revision:</td>
        <td>Date:</td>

        <td>Revision:</td>
        <td>Date:</td>

        <td>Revision:</td>
        <td>Date:</td>
    </tr>

    @foreach(array_chunk($policy->policy_revision_dates ?? [], 4) as $row)
        <tr class="revision-data-row">

            @for($i = 0; $i < 4; $i++)
                <td>
                    {{ $row[$i]['revision'] ?? '' }}
                </td>

                <td>
                    {{ $row[$i]['date'] ?? '' }}
                </td>
            @endfor

        </tr>
    @endforeach

    @for($x = 0; $x < 4; $x++)
        <tr class="revision-data-row">
            <td>&nbsp;</td>
            <td></td>

            <td></td>
            <td></td>

            <td></td>
            <td></td>

            <td></td>
            <td></td>
        </tr>
    @endfor

</table>

<div class="section-title" style="margin-top: 25px;">
    SIGNATURES:
</div>

<div class="signature-title">
    SIGNATURES:
</div>

<table class="signature-table">

    <tr>

        <td class="signature-label">
            POLICY OWNER:
        </td>

        <td class="signature-person">
            <div class="signature-name">
                {{ $policy->policy_owner }}
            </div>

            <div class="signature-position">
                {{ $policy->policy_owner_title }}
            </div>
        </td>

        <td class="signature-box">
            &nbsp;
        </td>

        <td class="date-box">
            DATE:
            <span class="date-value">
                {{ $policy->policy_owner_date }}
            </span>
        </td>

    </tr>

    <tr>

        <td class="signature-label">
            POLICY REVIEWER:
        </td>

        <td class="signature-person">
            <div class="signature-name">
                {{ $policy->policy_reviewer }}
            </div>

            <div class="signature-position">
                {{ $policy->policy_reviewer_title }}
            </div>
        </td>

        <td class="signature-box">
            &nbsp;
        </td>

        <td class="date-box">
            DATE:
            <span class="date-value">
                {{ $policy->policy_reviewer_date }}
            </span>
        </td>

    </tr>

    <tr>

        <td class="signature-label">
            SUPERINTENDENT APPROVAL:
        </td>

        <td class="signature-person">
            <div class="signature-name">
                {{ $policy->superintendent_approval }}
            </div>

            <div class="signature-position">
                SUPERINTENDENT
            </div>
        </td>

        <td class="signature-box">
            &nbsp;
        </td>

        <td class="date-box">
            DATE:
            <span class="date-value">
                {{ $policy->superintendent_approval_date }}
            </span>
        </td>

    </tr>

</table>
