<div class="space-y-6">

    @if ($module->passing_score ?? null)
        <div class="rounded-xl border border-blue-900 bg-blue-950/20 px-5 py-4">

            <p class="text-sm text-gray-300">
                Passing Score:
                <span class="font-semibold text-blue-300">
                    {{ $module->passing_score }}%
                </span>
            </p>

        </div>
    @endif

    @forelse ($module->questions ?? [] as $index => $question)
        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

            <div class="flex gap-4">

                <div
                    class="flex h-8 w-8 shrink-0 items-center justify-center
                           rounded-full bg-gray-800 text-sm
                           font-semibold text-gray-300">

                    {{ $index + 1 }}

                </div>

                <div class="min-w-0 flex-1">

                    <p class="font-medium leading-6 text-gray-100">
                        {{ $question->question }}
                    </p>

                    <p class="mt-2 text-xs uppercase tracking-wide text-gray-500">
                        {{ str_replace('_', ' ', $question->type) }}
                    </p>

                    {{-- Answer controls will go here later --}}

                </div>

            </div>

        </div>

    @empty

        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">
            <p class="text-sm text-gray-400">
                No test questions are available.
            </p>
        </div>
    @endforelse

</div>
