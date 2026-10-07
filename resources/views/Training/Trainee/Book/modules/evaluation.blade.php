<div class="space-y-6">

    @if (($module->days ?? 1) > 1)
        <div class="rounded-xl border border-gray-800 bg-gray-900 px-6 py-4">

            <p class="text-sm text-gray-400">
                Evaluation Period
            </p>

            <p class="mt-1 font-semibold text-white">
                {{ $module->days }} Days
            </p>

        </div>
    @endif

    @forelse ($module->items ?? $module->fields ?? [] as $field)
        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

            <h3 class="font-semibold text-gray-100">
                {{ $field->item ?? ($field->name ?? 'Evaluation Item') }}
            </h3>

            @if ($field->description ?? null)
                <p class="mt-2 text-sm leading-6 text-gray-400">
                    {{ $field->description }}
                </p>
            @endif

            <div class="mt-4 rounded-lg border border-gray-800 bg-gray-950 p-4">

                <p class="text-sm italic text-gray-500">
                    Evaluation response will be entered here.
                </p>

            </div>

        </div>

    @empty

        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">
            <p class="text-sm text-gray-400">
                No evaluation fields are available.
            </p>
        </div>
    @endforelse

</div>
