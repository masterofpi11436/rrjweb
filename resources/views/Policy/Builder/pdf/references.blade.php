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
        margin-top: 12px;
        margin-bottom: 8px;
    }

    .aca-reference {
        font-weight: bold;
        margin-bottom: 4px;
    }

    .paragraph {
        text-align: justify;
        line-height: 1.4;
        margin-bottom: 5px;
    }

    .bullet {
        margin-left: 20px;
        margin-bottom: 2px;
    }
</style>

<div class="page-title">
    REFERENCES
</div>

@foreach ($policy->references as $reference)
    <div class="reference-title">{{ $reference->reference_title }}</div>

    @foreach ($reference->paragraphs as $paragraph)
        @if ($paragraph->aca_reference)
            <div class="aca-reference">{{ $paragraph->aca_reference }}</div>
        @endif

        @if ($paragraph->paragraph)
            <div class="paragraph">{{ $paragraph->paragraph }}</div>
        @endif

        @foreach ($paragraph->bullets as $bullet)
            <div class="bullet">
                <img src="{{ public_path('images/four-diamond-square-bullet.svg') }}" width="8"
                    height="8">{{ $bullet->list['text'] ?? '' }}
            </div>
        @endforeach
    @endforeach
@endforeach
