{{-- resources/views/Policy/Builder/pdf/toc.blade.php --}}

<style>
    body {
        font-family: times;
        font-size: 11pt;
        color: #000;
    }

    .toc-title {
        font-size: 16pt;
        font-weight: bold;
        margin-bottom: 18px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        vertical-align: top;
        padding: 4px 0;
    }

    .chapter-number {
        width: 90px;
        font-weight: bold;
    }

    .chapter-title {
        font-weight: bold;
    }

    .section-number {
        width: 90px;
        padding-left: 90px;
    }

    .section-title {
        padding-left: 20px;
    }

    .references {
        margin-top: 18px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .footer-title {
        position: absolute;
        bottom: 12px;
        right: 20px;
        font-size: 9pt;
        font-weight: bold;
    }
</style>

<div class="toc-title">Table of Contents</div>

<table>
    @foreach($policy->chapters as $chapterIndex => $chapter)
        <tr>
            <td class="chapter-number">
                Chapter {{ $chapterIndex + 1 }} -
            </td>
            <td class="chapter-title">
                {{ $chapter->chapter_title }}
            </td>
        </tr>

        @foreach($chapter->sections as $sectionIndex => $section)
            <tr>
                <td class="section-number">
                    {{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}
                </td>
                <td class="section-title">
                    {{ $section->section_title }}
                </td>
            </tr>
        @endforeach
    @endforeach
</table>

@if($policy->references)
    <div class="references">REFERENCES</div>
@endif

<div class="footer-title">
    {{ $policy->policy_number ?? '' }} {{ $policy->title }}
</div>
