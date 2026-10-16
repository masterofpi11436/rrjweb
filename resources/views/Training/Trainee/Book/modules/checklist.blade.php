<div class="space-y-6">

    @forelse ($module->groups as $group)

        <section class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">

            {{-- Group Header --}}
            <div class="border-b border-gray-800 bg-gray-800/50 px-6 py-4">

                <h3 class="text-lg font-semibold text-white">
                    {{ $group->title }}
                </h3>

                @if ($group->description)
                    <p class="mt-2 text-sm leading-6 text-gray-400">
                        {{ $group->description }}
                    </p>
                @endif

            </div>

            {{-- Checklist Items --}}
            <div class="divide-y divide-gray-800">

                @forelse ($group->items as $index => $item)
                    <div class="flex items-start gap-4 px-6 py-5">

                        {{-- Item Number --}}
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center
                                   rounded-md border border-gray-600
                                   bg-gray-800 text-sm font-semibold text-gray-300">

                            {{ $index + 1 }}

                        </div>

                        {{-- Item Content --}}
                        <div class="min-w-0 flex-1">

                            <p class="font-medium leading-6 text-gray-200">
                                {{ $item->item }}
                            </p>

                            @if ($item->description)
                                <p class="mt-2 text-sm leading-6 text-gray-400">
                                    {{ $item->description }}
                                </p>
                            @endif

                        </div>

                        {{-- Trainee Sign Off --}}
                        <div class="min-w-[130px] text-center">

                            <p class="mb-2 text-xs font-semibold text-gray-400">
                                Trainee
                            </p>

                            @if ($traineeSignoff)
                                <div class="text-sm font-medium text-green-400">
                                    Signed
                                </div>

                                <p class="mt-1 text-xs text-gray-400">
                                    {{ $traineeSignoff->signed_at->format('m/d/Y h:i A') }}
                                </p>
                            @else
                                <form method="POST"
                                    action="{{ route('training.trainee.book.checklist.sign', [
                                        'assignment' => $assignment->id,
                                        'item' => $assignmentItem->id,
                                    ]) }}">

                                    @csrf

                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to sign off on this item?')"
                                        class="rounded-md border border-green-500 bg-green-700
                                                px-4 py-2 text-sm font-medium text-white
                                                transition hover:bg-green-600">

                                        Sign Off

                                    </button>
                                </form>
                            @endif

                        </div>


                        {{-- FTO Sign Off --}}
                        <div class="min-w-[130px] text-center">

                            <p class="mb-2 text-xs font-semibold text-gray-400">
                                FTO
                            </p>

                            @if ($ftoSignoff)
                                <div class="text-sm font-medium text-green-400">
                                    Signed
                                </div>

                                <p class="mt-1 text-xs text-gray-400">
                                    {{ $ftoSignoff->signed_at->format('m/d/Y h:i A') }}
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
                            No checklist items are available in this group.
                        </p>
                    </div>
                @endforelse

            </div>

        </section>

    @empty

        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

            <p class="text-sm text-gray-400">
                No checklist groups are available.
            </p>

        </div>

    @endforelse

</div>
