<style>
    .page-title {
        font-size: 18pt;
        font-weight: bold;
        text-align: left;
        margin-bottom: 20px;
    }

    .reference-title {
        font-size: 12pt;
        font-weight: bold;
    }

    .aca-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 4px;
    }

    .aca-first {
        padding-top: 15px;
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
        margin-bottom: 6px;
    }

    .bullet {
        margin-left: 20px;
        line-height: 1.2;
    }

    .reference-spacing {
        height: 8px;
    }

    .first {
        margin-top: 10005px;
    }
</style>

<div class="page-title">REFERENCES</div>
@foreach ($policy->references as $reference)
    <div class="reference-title">{{ $reference->reference_title }}</div>
    @foreach ($reference->paragraphs as $paragraph)
        @if ($paragraph->aca_reference)
            <table class="aca-table"><tr><td class="aca-left">{{ $paragraph->aca_reference }}</td><td class="aca-right">{{ $paragraph->paragraph }}</td></tr></table>
        @elseif ($paragraph->paragraph)<div class="paragraph">{{ $paragraph->paragraph }}</div>
        @endif

        @foreach ($paragraph->bullets as $bullet)
            <div class="bullet">
                • {{ $bullet->list['text'] ?? '' }}
            </div>
        @endforeach
        <div class="reference-spacing"></div>
    @endforeach
@endforeach
