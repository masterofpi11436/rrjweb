<style>
    .toc-title {
        font-size: 13pt;
        font-weight: bold;
        margin-bottom: 18px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        vertical-align: top;
        padding: 3px 0;
    }

    .chapter-number {
        width: 75px;
        font-weight: bold;
    }

    .chapter-title {
        font-weight: bold;
    }

    .section-number {
        width: 90px;
        padding-left: 80px;
    }

    .section-title {
        padding-left: 10px;
    }

    .references {
        margin-top: 12px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .footer-table {
        margin-top: 660px;
        font-size: 9pt;
        font-weight: bold;
    }

    .footer-policy {
        text-align: right;
    }
</style>


<div class="toc-title">Table of Contents</div>

<br>

<table>
    @foreach($policy->chapters as $chapterIndex => $chapter)
<br>
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
                <td></td>

                <td class="section-title">
                    {{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}
                    &nbsp;&nbsp;&nbsp;
                    {{ $section->section_title }}
                </td>
            </tr>

        @endforeach

    @endforeach
</table>
