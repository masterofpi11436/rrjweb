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
        margin-top: 10px;
    }

    .revision-table td {
        border: 1px solid #9be3b1;
        padding: 5px;
        height: 22px;
        font-size: 10pt;
    }

    .revision-header {
        background-color: #6fd08c;
        font-weight: bold;
    }

    .signature-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .signature-table td {
        border: 1px solid #666;
        padding: 6px;
        height: 40px;
        font-size: 10pt;
    }

    .label {
        width: 180px;
        font-weight: bold;
    }

    .signature-name {
        font-weight: bold;
    }

    .signature-title {
        font-size: 9pt;
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

    @for($i = 0; $i < 8; $i += 4)
        <tr>
            <td>{{ $policy->policy_revision_dates[$i]['revision'] ?? '' }}</td>
            <td>{{ $policy->policy_revision_dates[$i]['date'] ?? '' }}</td>

            <td>{{ $policy->policy_revision_dates[$i+1]['revision'] ?? '' }}</td>
            <td>{{ $policy->policy_revision_dates[$i+1]['date'] ?? '' }}</td>

            <td>{{ $policy->policy_revision_dates[$i+2]['revision'] ?? '' }}</td>
            <td>{{ $policy->policy_revision_dates[$i+2]['date'] ?? '' }}</td>

            <td>{{ $policy->policy_revision_dates[$i+3]['revision'] ?? '' }}</td>
            <td>{{ $policy->policy_revision_dates[$i+3]['date'] ?? '' }}</td>
        </tr>
    @endfor

    @for($x = 0; $x < 4; $x++)
        <tr>
            <td></td>
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

<table class="signature-table">

    <tr>
        <td class="label">
            POLICY OWNER:
        </td>

        <td>
            <div class="signature-name">
                {{ $policy->policy_owner }}
            </div>

            <div class="signature-title">
                {{ $policy->policy_owner_title }}
            </div>
        </td>

        <td>
            {{ $policy->policy_owner_signature ?? '' }}
        </td>

        <td>
            <strong>DATE:</strong><br>
            {{ $policy->policy_owner_date }}
        </td>
    </tr>

    <tr>
        <td class="label">
            POLICY REVIEWER:
        </td>

        <td>
            <div class="signature-name">
                {{ $policy->policy_reviewer }}
            </div>

            <div class="signature-title">
                {{ $policy->policy_reviewer_title }}
            </div>
        </td>

        <td>
            {{ $policy->policy_reviewer_signature ?? '' }}
        </td>

        <td>
            <strong>DATE:</strong><br>
            {{ $policy->policy_reviewer_date }}
        </td>
    </tr>

    <tr>
        <td class="label">
            SUPERINTENDENT APPROVAL:
        </td>

        <td>
            <div class="signature-name">
                {{ $policy->superintendent_approval }}
            </div>

            <div class="signature-title">
                SUPERINTENDENT
            </div>
        </td>

        <td>
            {{ $policy->superintendent_signature ?? '' }}
        </td>

        <td>
            <strong>DATE:</strong><br>
            {{ $policy->superintendent_approval_date }}
        </td>
    </tr>

</table>
