<style>
    .page-title {
        font-size: 18pt;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .reference-title {
        font-size: 12pt;
        font-weight: bold;
    }

    .aca-table {
        width: 100%;
    }

    .aca-left {
        width: 28%;
        font-weight: bold;
        vertical-align: top;
        padding-right: 8px;
        line-height: 1.1;
    }

    .aca-right {
        width: 72%;
        vertical-align: top;
        text-align: justify;
        line-height: 1.1;
    }

    .paragraph {
        text-align: justify;
        line-height: 1.1;
    }

    .bullet {
        margin-left: 20px;
    }
</style>

<div class="page-title">REFERENCES</div>

@foreach ($policy->references as $reference)
    <div class="reference-title">{{ $reference->reference_title }}</div>

    @foreach ($reference->paragraphs as $paragraph)
        @if ($paragraph->aca_reference)
            <div class="aca-reference"><strong>{{ $paragraph->aca_reference }}</strong></div>
        @endif

        @if ($paragraph->paragraph)
            <div class="paragraph">{{ $paragraph->paragraph }}</div>
        @endif

        @foreach ($paragraph->bullets as $bullet)
            <div class="bullet">• {{ $bullet->list['text'] ?? '' }}</div>
        @endforeach
    @endforeach
    <div></div>
@endforeach
