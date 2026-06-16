{{-- resources/views/Policy/Builder/pdf/body.blade.php --}}

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        vertical-align: top;
    }

    .chapter-number {
        width: 22mm;
        font-size: 14pt;
        font-weight: bold;
    }

    .chapter-title {
        font-weight: bold;
        font-size: 14pt;
    }

    .section-number {
        width: 12mm;
        font-size: 12pt;
        font-weight: bold;
    }

    .section-title {
        font-weight: bold;
        font-size: 12pt;
    }

    .section-row td {
        padding-top: 20mm;
        padding-bottom: 8mm;
    }

    .paragraph-number {
        width: 18mm;
        padding-top: 1mm;
        font-size: 11pt;
        font-weight: normal;
    }

    .paragraph-text {
        width: 82%;
        line-height: 1.25;
        padding-bottom: 3mm;
        text-align: justify;
        font-size: 11pt;
        font-weight: normal;
    }

    .bullet-list {
        margin: 20mm 0 3mm 0;
        padding-left: 8mm;
    }

    .bullet-list li {
        line-height: 1.25;
        padding-bottom: 1mm;
    }
</style>

@foreach ($policy->chapters as $chapterIndex => $chapter)
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="chapter-number">Chapter {{ $chapterIndex + 1 }}</td>

            <td class="chapter-title">{{ $chapter->chapter_title }}</td>
        </tr>
    </table><br><br>
    @foreach ($chapter->sections as $sectionIndex => $section)
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="2" style="height:5mm;"></td>
            </tr>
            <tr class="section-row">
                <td class="section-number">{{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}</td>

                <td class="section-title">{{ $section->section_title }}</td>
            </tr><br>
            @foreach ($section->paragraphs as $paragraphIndex => $paragraph)
                <tr>
                    <td class="paragraph-number">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}.{{ $paragraphIndex + 1 }}
                    </td>

                    <td class="paragraph-text">{{ $paragraph->paragraph }}</td>
                </tr>
                @if ($paragraph->bullets->count())
                    <tr>
                        <br>
                        <td></td>
                        <td class="paragraph-text">
                            <ul class="bullet-list">
                                @foreach ($paragraph->bullets as $bullet)
                                    • {{ $bullet->list['text'] ?? '' }}<br>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif
                <br>
            @endforeach
            <br>
        </table>
    @endforeach
@endforeach
