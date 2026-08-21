<style>
    .page-title {
        font-size: 18pt;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .reference-table {
        width: 100%;
        border-collapse: collapse;
    }

    .reference-title {
        font-size: 12pt;
        font-weight: bold;
    }

    .reference-title-spacing {
        font-size: 5pt;
        line-height: 5pt;
    }

    .aca-left {
        width: 18%;
        font-weight: bold;
        vertical-align: top;
        padding-right: 12px;
        line-height: 1.2;
    }

    .aca-right {
        width: 82%;
        vertical-align: top;
        text-align: left;
        line-height: 1.2;
    }

    .paragraph {
        text-align: justify;
        line-height: 1.2;
    }

    .bullet {
        margin-left: 20px;
        line-height: 1.2;
    }

    .paragraph-spacing {
        font-size: 4pt;
        line-height: 4pt;
    }

    .reference-spacing {
        font-size: 15pt;
        line-height: 15pt;
    }
</style>

<div class="page-title">REFERENCES</div>

@foreach ($policy->references as $reference)

    <table class="reference-table">

        {{-- Reference Title --}}
        <tr>
            <td colspan="2" class="reference-title">
                {{ $reference->reference_title }}
            </td>
        </tr>

        {{-- Space between title and first paragraph --}}
        <tr>
            <td colspan="2" class="reference-title-spacing">
                &nbsp;
            </td>
        </tr>

        @foreach ($reference->paragraphs as $paragraph)

            {{-- ACA Reference --}}
            @if ($paragraph->aca_reference)
                <tr>
                    <td class="aca-left">
                        {{ $paragraph->aca_reference }}
                    </td>

                    <td class="aca-right">
                        {{ $paragraph->paragraph }}
                    </td>
                </tr>

            {{-- Normal Paragraph --}}
            @elseif ($paragraph->paragraph)
                <tr>
                    <td colspan="2" class="paragraph">
                        {{ $paragraph->paragraph }}
                    </td>
                </tr>
            @endif

            {{-- Bullets --}}
            @foreach ($paragraph->bullets as $bullet)
                <tr>
                    <td colspan="2" class="bullet">
                        • {{ $bullet->list['text'] ?? '' }}
                    </td>
                </tr>
            @endforeach

            {{-- Space between paragraphs --}}
            @if (!$loop->last)
                <tr>
                    <td colspan="2" class="paragraph-spacing">
                        &nbsp;
                    </td>
                </tr>
            @endif

        @endforeach

    </table>

    {{-- Space between references --}}
    @if (!$loop->last)
        <div class="reference-spacing">&nbsp;</div>
    @endif

@endforeach
