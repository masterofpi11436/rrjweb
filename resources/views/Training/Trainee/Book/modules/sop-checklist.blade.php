<div class="space-y-6">

    @forelse ($module->groups as $group)

        <section class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">

            {{-- Group Header --}}
            <div class="border-b border-gray-800 bg-gray-800/50 px-6 py-5">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-4">

                    {{-- Section Number --}}
                    @if ($group->section_number)
                        <span
                            class="inline-flex w-fit items-center rounded-md
                                   border border-blue-800 bg-blue-950/40
                                   px-3 py-1 text-sm font-semibold text-blue-300">

                            Section {{ $group->section_number }}

                        </span>
                    @endif

                    {{-- Group Title --}}
                    <h3 class="text-lg font-semibold text-white">
                        {{ $group->title }}
                    </h3>

                </div>

                {{-- Group Description --}}
                @if ($group->description)
                    <p class="mt-3 text-sm leading-6 text-gray-400">
                        {{ $group->description }}
                    </p>
                @endif

            </div>

            {{-- Policies --}}
            <div class="divide-y divide-gray-800">

                @forelse ($group->policies as $policy)
                    @php
                        $assignmentItem = $assignmentModule->items->firstWhere('module_item_id', $policy->id);

                        $traineeSignoff = $assignmentItem?->signoffs?->first(
                            fn($signoff) => $signoff->requirement?->signer_role === 'trainee',
                        );

                        $ftoSignoff = $assignmentItem?->signoffs?->first(
                            fn($signoff) => $signoff->requirement?->signer_role === 'fto',
                        );
                    @endphp
                    <div
                        class="flex flex-col gap-3 px-6 py-5
                                sm:flex-row sm:items-start sm:gap-6">

                        {{-- Policy Number --}}
                        <div class="shrink-0 sm:w-36">

                            @if ($policy->policy_number)
                                <span
                                    class="inline-flex rounded-md
                                           border border-gray-700
                                           bg-gray-800
                                           px-3 py-1.5
                                           text-sm font-semibold text-gray-300">

                                    {{ $policy->policy_number }}

                                </span>
                            @endif

                        </div>

                        {{-- Policy Title --}}
                        <div class="min-w-0 flex-1">

                            <p class="font-medium leading-6 text-gray-200">
                                {{ $policy->title }}
                            </p>

                        </div>


                        {{-- Trainee Sign Off --}}
                        <div class="min-w-[150px] text-center">

                            <p class="mb-2 text-xs font-semibold text-gray-400">
                                Trainee
                            </p>

                            @if ($traineeSignoff)
                                <div class="font-semibold text-green-400">
                                    {{ $traineeSignoff->signer?->initials ?? 'Signed' }}
                                </div>

                                <p class="mt-1 text-xs text-gray-400">
                                    {{ $traineeSignoff->signed_at?->format('m/d/Y h:i A') }}
                                </p>
                            @elseif ($assignmentItem && $assignment->status !== 'completed')
                                <form method="POST"
                                    action="{{ route('training.trainee.book.checklist.sign', [
                                        'assignment' => $assignment->id,
                                        'item' => $assignmentItem->id,
                                    ]) }}">

                                    @csrf

                                    <button type="submit"
                                        onclick="return confirm('Sign your initials for this SOP policy?')"
                                        class="rounded-md border border-green-500
                                                bg-green-700 px-4 py-2 text-sm
                                                font-medium text-white
                                                transition hover:bg-green-600">

                                        Sign Initials

                                    </button>

                                </form>
                            @else
                                <span class="text-sm text-gray-500">
                                    Unavailable
                                </span>
                            @endif

                        </div>

                        {{-- FTO Sign Off --}}
                        <div class="min-w-[130px] text-center">

                            <p class="mb-2 text-xs font-semibold text-gray-400">
                                FTO
                            </p>

                            @if ($ftoSignoff)
                                <div class="font-semibold text-green-400">
                                    Signed
                                </div>

                                <p class="mt-1 text-xs text-gray-400">
                                    {{ $ftoSignoff->signed_at?->format('m/d/Y h:i A') }}
                                </p>
                            @else
                                <span class="text-sm text-yellow-400">
                                    Pending
                                </span>
                            @endif

                        </div>


                    </div>

                @empty

                    <div class="px-6 py-5">

                        <p class="text-sm text-gray-400">
                            No policies are available in this section.
                        </p>

                    </div>
                @endforelse

            </div>

        </section>

    @empty

        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

            <p class="text-sm text-gray-400">
                No SOP sections are available.
            </p>

        </div>

    @endforelse

</div>
