{{-- resources/views/Policy/Builder/pdf/body.blade.php --}}

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

    .chapter-header {
        font-weight: bold;
        margin-bottom: 18px;
    }

    .chapter-number {
        width: 90px;
        font-weight: bold;
    }

    .chapter-title {
        font-weight: bold;
    }

    .section-row td {
        padding-top: 14px;
        padding-bottom: 10px;
    }

    .section-number {
        width: 70px;
        font-weight: bold;
    }

    .section-title {
        font-weight: bold;
    }

    .paragraph-number {
        width: 70px;
        padding-top: 4px;
    }

    .paragraph-text {
        line-height: 1.45;
        padding-bottom: 8px;
        text-align: justify;
    }

    .footer-title {
        position: absolute;
        bottom: 12px;
        right: 20px;
        font-size: 9pt;
        font-weight: bold;
    }

    .references-title {
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .reference-content {
        line-height: 1.45;
        text-align: justify;
    }
</style>

@foreach($policy->chapters as $chapterIndex => $chapter)
    <table>
        <tr>
            <td class="chapter-number">
                Chapter {{ $chapterIndex + 1 }}
            </td>
            <td class="chapter-title">
                {{ $chapter->chapter_title }}
            </td>
        </tr>
    </table>

    @foreach($chapter->sections as $sectionIndex => $section)
        <table>
            <tr class="section-row">
                <td class="section-number">
                    {{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}
                </td>
                <td class="section-title">
                    {{ $section->section_title }}
                </td>
            </tr>

            @foreach($section->paragraphs as $paragraphIndex => $paragraph)
                <tr>
                    <td class="paragraph-number">
                        {{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}.{{ $paragraphIndex + 1 }}
                    </td>
                    <td class="paragraph-text">
                        {{ $paragraph->paragraph }}
                    </td>
                </tr>

                @foreach($paragraph->bullets as $bulletIndex => $bullet)
                    <tr>
                        <td class="paragraph-number">
                            {{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}.{{ $paragraphIndex + 1 }}.{{ $bulletIndex + 1 }}
                        </td>
                        <td class="paragraph-text">
                            {{ $bullet->list['text'] ?? '' }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    @endforeach
@endforeach

@if($policy->references)
    <div style="page-break-before: always;"></div>

    <div class="references-title">
        REFERENCES:
    </div>

    <div class="reference-content">
        {!! nl2br(e($policy->references)) !!}
    </div>
@endif

<div class="footer-title">
    {{ $policy->policy_number ?? '' }} {{ $policy->title }}
</div>
