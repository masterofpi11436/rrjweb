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
