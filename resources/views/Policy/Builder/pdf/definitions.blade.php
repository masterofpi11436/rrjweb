<style>
    .page-title {
        font-size: 18pt;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }

    .definition {
        font-size: 11pt;
        margin-bottom: 10px;
        line-height: 1.4;
        font-weight: normal;
    }

    .term {
        font-weight: bold;
    }
</style>

<div class="page-title">
    DEFINITIONS
</div>

@foreach ($policy->policyDefinitions as $definition)
    <div class="definition">
        <span class="term">{{ $definition->word }}</span>
        — {{ $definition->definition }}
    </div>
@endforeach
