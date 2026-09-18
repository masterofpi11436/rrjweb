<div>

    <form wire:submit="save">

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[280px_minmax(0,1fr)]">


            {{-- ========================================================= --}}
            {{-- LEFT SIDEBAR --}}
            {{-- ========================================================= --}}

            <aside>

                <div class="sticky top-50 space-y-4">


                    {{-- Navigation --}}
                    <section
                        class="overflow-hidden rounded-lg
                               border border-gray-700
                               bg-gray-900">

                        <div class="border-b border-gray-700
                                   bg-gray-800 px-4 py-3">

                            <h2 class="text-sm font-semibold
                                       text-white">
                                SOP Checklist
                            </h2>

                            <p class="mt-1 text-xs
                                       text-gray-400">
                                Module Navigation
                            </p>

                        </div>


                        <nav class="space-y-1 p-2">

                            <a href="#checklist-details"
                                class="block rounded-md
                                       px-3 py-2 text-sm
                                       text-gray-300
                                       hover:bg-gray-800
                                       hover:text-white">

                                Checklist Details

                            </a>

                            <a href="#groups"
                                class="flex items-center
                                       justify-between
                                       rounded-md px-3 py-2
                                       text-sm text-gray-300
                                       hover:bg-gray-800
                                       hover:text-white">

                                <span>
                                    Groups
                                </span>

                                <span
                                    class="rounded-full
                                           bg-gray-700
                                           px-2 py-0.5
                                           text-xs text-gray-300">

                                    {{ count($groups) }}

                                </span>

                            </a>

                        </nav>

                    </section>



                    {{-- Group List --}}
                    <section
                        class="overflow-hidden rounded-lg
                               border border-gray-700
                               bg-gray-900">

                        <div
                            class="flex items-center
                                   justify-between
                                   border-b border-gray-700
                                   bg-gray-800
                                   px-4 py-3">

                            <div>

                                <h2 class="text-sm font-semibold
                                           text-white">
                                    Groups
                                </h2>

                                <p class="mt-0.5 text-xs
                                           text-gray-400">
                                    SOP Sections
                                </p>

                            </div>


                            <button type="button" wire:click="addGroup" title="Add Group"
                                class="flex h-7 w-7
                                       items-center
                                       justify-center
                                       rounded-md bg-blue-600
                                       text-lg font-semibold
                                       text-white
                                       hover:bg-blue-500">

                                +

                            </button>

                        </div>


                        <div class="space-y-1 p-2">

                            @foreach ($groups as $groupIndex => $group)
                                <a href="#group-{{ $groupIndex }}"
                                    wire:key="sidebar-group-{{ $group['id'] ?? 'new-' . $groupIndex }}"
                                    class="flex items-center
                                           justify-between gap-2
                                           rounded-md px-3 py-2
                                           text-sm text-gray-300
                                           hover:bg-gray-800
                                           hover:text-white">

                                    <div class="min-w-0">

                                        <div class="truncate font-medium">

                                            {{ !empty($group['title']) ? $group['title'] : 'Untitled Group' }}

                                        </div>

                                        @if (!empty($group['section_number']))
                                            <div
                                                class="text-xs
                                                       text-gray-500">

                                                Section
                                                {{ $group['section_number'] }}

                                            </div>
                                        @endif

                                    </div>


                                    <span
                                        class="shrink-0 rounded-full
                                               bg-gray-700
                                               px-2 py-0.5
                                               text-xs text-gray-400">

                                        {{ count($group['policies']) }}

                                    </span>

                                </a>
                            @endforeach

                        </div>

                    </section>



                    {{-- Add Group --}}
                    <a wire:click="addGroup"
                        class="px-4 py-2
                                    bg-slate-700 text-gray-100
                                    rounded-md border border-green-500
                                    hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                    transition block text-center">

                        + Add Group

                    </a>

                </div>

            </aside>



            {{-- ========================================================= --}}
            {{-- MAIN CONTENT --}}
            {{-- ========================================================= --}}

            <main class="min-w-0 space-y-5">


                {{-- Checklist Details --}}
                <section id="checklist-details"
                    class="overflow-hidden rounded-lg
                           border border-gray-700
                           bg-gray-900">

                    <div class="border-b border-gray-700
                               bg-gray-800 px-4 py-3">

                        <h2 class="font-semibold text-white">
                            Checklist Details
                        </h2>

                        <p class="mt-1 text-sm
                                   text-gray-400">

                            Basic information for this
                            SOP checklist.

                        </p>

                    </div>


                    <div class="space-y-4 p-4">


                        {{-- Title --}}
                        <div>

                            <label for="title"
                                class="mb-1.5 block
                                       text-sm font-medium
                                       text-gray-200">

                                Checklist Title

                            </label>


                            <input id="title" type="text" wire:model="title"
                                placeholder="Example: Standard Operating Procedure Acceptance and Acknowledgement"
                                class="w-full rounded-lg
                                       border border-gray-600
                                       bg-gray-800
                                       px-3 py-2.5
                                       text-white
                                       placeholder:text-gray-500
                                       focus:border-blue-500
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-blue-500/30">


                            @error('title')
                                <p class="mt-1 text-sm
                                           text-red-400">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>



                        {{-- Description --}}
                        <div>

                            <label for="description"
                                class="mb-1.5 block
                                       text-sm font-medium
                                       text-gray-200">

                                Description

                            </label>


                            <textarea id="description" wire:model="description" rows="2" placeholder="Optional description"
                                class="w-full rounded-lg
                                       border border-gray-600
                                       bg-gray-800
                                       px-3 py-2.5
                                       text-white
                                       placeholder:text-gray-500
                                       focus:border-blue-500
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-blue-500/30"></textarea>


                            @error('description')
                                <p class="mt-1 text-sm
                                           text-red-400">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                    </div>

                </section>



                {{-- Groups --}}
                <div id="groups" class="space-y-4">


                    @error('groups')
                        <div
                            class="rounded-lg border
                                   border-red-700
                                   bg-red-950/40
                                   px-4 py-3
                                   text-sm text-red-300">

                            {{ $message }}

                        </div>
                    @enderror



                    @foreach ($groups as $groupIndex => $group)
                        <section id="group-{{ $groupIndex }}"
                            wire:key="sop-group-{{ $group['id'] ?? 'new-' . $groupIndex }}"
                            class="scroll-mt-4
                                   overflow-hidden
                                   rounded-lg
                                   border border-gray-700
                                   bg-gray-900">


                            {{-- Group Header --}}
                            <div
                                class="flex flex-wrap
                                       items-center
                                       justify-between
                                       gap-3
                                       border-b
                                       border-gray-700
                                       bg-gray-800
                                       px-4 py-3">


                                <div class="flex items-center
                                           gap-3">

                                    <span
                                        class="flex h-8 w-8
                                               items-center
                                               justify-center
                                               rounded-md
                                               bg-gray-700
                                               text-xs
                                               font-bold
                                               text-gray-300">

                                        {{ $groupIndex + 1 }}

                                    </span>


                                    <div>

                                        <h3
                                            class="font-semibold
                                                   text-white">

                                            {{ !empty($group['title']) ? $group['title'] : 'Untitled Group' }}

                                        </h3>


                                        <p
                                            class="text-xs
                                                   text-gray-400">

                                            @if (!empty($group['section_number']))
                                                Section
                                                {{ $group['section_number'] }}
                                                •
                                            @endif

                                            {{ count($group['policies']) }}

                                            {{ count($group['policies']) === 1 ? 'policy' : 'policies' }}

                                        </p>

                                    </div>

                                </div>



                                {{-- Group Controls --}}
                                <div class="flex items-center
                                           gap-1">


                                    {{-- Move Up --}}
                                    <a wire:click="moveGroupUp({{ $groupIndex }})" @disabled($groupIndex === 0)
                                        title="Move Group Up"
                                        class="px-4 py-2
                                            bg-slate-700 text-gray-100
                                            rounded-md border border-blue-500
                                            hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                                            transition inline-block text-center
                                            disabled:cursor-not-allowed disabled:opacity-25">

                                        ↑

                                    </a>

                                    {{-- Move Down --}}
                                    <a wire:click="moveGroupDown({{ $groupIndex }})" @disabled($groupIndex === count($groups) - 1)
                                        title="Move Group Down"
                                        class="px-4 py-2
                                            bg-slate-700 text-gray-100
                                            rounded-md border border-blue-500
                                            hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                                            transition inline-block text-center
                                            disabled:cursor-not-allowed disabled:opacity-25">

                                        ↓

                                    </a>

                                    {{-- Insert --}}
                                    <a type="button" wire:click="insertGroup({{ $groupIndex }})"
                                        title="Insert Group Below"
                                        class="px-4 py-2
                                            bg-slate-700 text-gray-100
                                            rounded-md border border-green-500
                                            hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                            transition inline-block text-center
                                            disabled:cursor-not-allowed disabled:opacity-25">

                                        +

                                    </a>

                                    {{-- Remove --}}
                                    <a wire:click="removeGroup({{ $groupIndex }})"
                                        wire:confirm="Are you sure you want to remove this group and all of its policies?"
                                        title="Remove Group"
                                        class="px-4 py-2
                                            bg-slate-700 text-gray-100
                                            rounded-md border border-red-500
                                            hover:bg-slate-600 hover:border-red-400 cursor-pointer
                                            transition inline-block text-center">

                                        ×

                                    </a>

                                </div>

                            </div>



                            {{-- Group Information --}}
                            <div
                                class="grid grid-cols-1
                                       gap-3 border-b
                                       border-gray-700
                                       px-4 py-3
                                       lg:grid-cols-[minmax(250px,1fr)_160px]">


                                {{-- Group Title --}}
                                <div>

                                    <label for="group-title-{{ $groupIndex }}"
                                        class="mb-1 block
                                               text-xs font-medium
                                               uppercase
                                               tracking-wide
                                               text-gray-400">

                                        Group Title

                                    </label>


                                    <input id="group-title-{{ $groupIndex }}" type="text"
                                        wire:model="groups.{{ $groupIndex }}.title"
                                        placeholder="Example: Administration / Management"
                                        class="w-full rounded-md
                                               border border-gray-600
                                               bg-gray-950
                                               px-3 py-2
                                               text-sm text-white
                                               placeholder:text-gray-600
                                               focus:border-blue-500
                                               focus:outline-none">


                                    @error("groups.$groupIndex.title")
                                        <p
                                            class="mt-1 text-xs
                                                   text-red-400">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- Section Number --}}
                                <div>

                                    <label for="section-number-{{ $groupIndex }}"
                                        class="mb-1 block
                                               text-xs font-medium
                                               uppercase
                                               tracking-wide
                                               text-gray-400">

                                        Section

                                    </label>


                                    <input id="section-number-{{ $groupIndex }}" type="text"
                                        wire:model="groups.{{ $groupIndex }}.section_number"
                                        placeholder="Example: 1.0"
                                        class="w-full rounded-md
                                               border border-gray-600
                                               bg-gray-950
                                               px-3 py-2
                                               text-sm text-white
                                               placeholder:text-gray-600
                                               focus:border-blue-500
                                               focus:outline-none">


                                    @error("groups.$groupIndex.section_number")
                                        <p
                                            class="mt-1 text-xs
                                                   text-red-400">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>

                            </div>



                            {{-- Optional Group Description --}}
                            <div
                                class="border-b
                                       border-gray-700
                                       px-4 py-3">

                                <label for="group-description-{{ $groupIndex }}"
                                    class="mb-1 block
                                           text-xs font-medium
                                           uppercase
                                           tracking-wide
                                           text-gray-400">

                                    Group Description

                                    <span
                                        class="normal-case
                                               text-gray-600">
                                        (optional)
                                    </span>

                                </label>


                                <input id="group-description-{{ $groupIndex }}" type="text"
                                    wire:model="groups.{{ $groupIndex }}.description"
                                    placeholder="Optional instructions or description"
                                    class="w-full rounded-md
                                           border border-gray-700
                                           bg-gray-950
                                           px-3 py-2
                                           text-sm text-white
                                           placeholder:text-gray-600
                                           focus:border-blue-500
                                           focus:outline-none">


                                @error("groups.$groupIndex.description")
                                    <p class="mt-1 text-xs
                                               text-red-400">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>



                            {{-- Policy Header --}}
                            <div
                                class="flex items-center
                                       justify-between
                                       border-b
                                       border-gray-700
                                       bg-gray-950/40
                                       px-4 py-2.5">

                                <div>

                                    <span
                                        class="text-xs
                                               font-semibold
                                               uppercase
                                               tracking-wide
                                               text-gray-400">

                                        Policies

                                    </span>

                                </div>


                                <a wire:click="addPolicy({{ $groupIndex }})"
                                    class="px-4 py-2
                                        bg-slate-700 text-gray-100
                                        rounded-md border border-green-500
                                        hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                        transition inline-block text-center">

                                    + Add Policy

                                </a>

                            </div>



                            @error("groups.$groupIndex.policies")
                                <div
                                    class="m-3 rounded-md
                                           border border-red-700
                                           bg-red-950/40
                                           px-3 py-2
                                           text-sm text-red-300">

                                    {{ $message }}

                                </div>
                            @enderror



                            {{-- Desktop Column Headers --}}
                            <div
                                class="hidden
                                       grid-cols-[40px_110px_minmax(180px,1fr)_140px]
                                       gap-3
                                       border-b
                                       border-gray-800
                                       bg-gray-950/30
                                       px-3 py-2
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wide
                                       text-gray-500
                                       lg:grid">

                                <div class="text-center">
                                    #
                                </div>

                                <div>
                                    Policy No.
                                </div>

                                <div>
                                    Policy Title
                                </div>

                                <div class="text-center">
                                    Actions
                                </div>

                            </div>



                            {{-- Policies --}}
                            <div class="divide-y
                                       divide-gray-800">

                                @foreach ($group['policies'] as $policyIndex => $policy)
                                    <div wire:key="sop-policy-{{ $groupIndex }}-{{ $policy['id'] ?? 'new-' . $policyIndex }}"
                                        class="px-3 py-2.5
                                               hover:bg-gray-800/30">


                                        <div
                                            class="grid grid-cols-1
                                                    gap-2
                                                    lg:grid-cols-[40px_110px_minmax(180px,1fr)_140px]
                                                    lg:items-start">


                                            {{-- Number --}}
                                            <div
                                                class="flex items-center
                                                       lg:justify-center">

                                                <span
                                                    class="flex h-8 w-8
                                                           items-center
                                                           justify-center
                                                           rounded-md
                                                           bg-gray-800
                                                           text-xs
                                                           font-semibold
                                                           text-gray-400">

                                                    {{ $policyIndex + 1 }}

                                                </span>

                                            </div>



                                            {{-- Policy Number --}}
                                            <div>

                                                <label for="policy-number-{{ $groupIndex }}-{{ $policyIndex }}"
                                                    class="mb-1 block
                                                           text-xs
                                                           font-medium
                                                           uppercase
                                                           text-gray-500
                                                           lg:hidden">

                                                    Policy Number

                                                </label>


                                                <input id="policy-number-{{ $groupIndex }}-{{ $policyIndex }}"
                                                    type="text"
                                                    wire:model="groups.{{ $groupIndex }}.policies.{{ $policyIndex }}.policy_number"
                                                    placeholder="Example: 1.5"
                                                    class="w-full
                                                           rounded-md
                                                           border
                                                           border-gray-700
                                                           bg-gray-950
                                                           px-2.5 py-2
                                                           text-sm
                                                           text-white
                                                           placeholder:text-gray-600
                                                           focus:border-blue-500
                                                           focus:outline-none">


                                                @error("groups.$groupIndex.policies.$policyIndex.policy_number")
                                                    <p
                                                        class="mt-1
                                                               text-xs
                                                               text-red-400">

                                                        {{ $message }}

                                                    </p>
                                                @enderror

                                            </div>



                                            {{-- Policy Title --}}
                                            <div>

                                                <label for="policy-title-{{ $groupIndex }}-{{ $policyIndex }}"
                                                    class="mb-1 block
                                                           text-xs
                                                           font-medium
                                                           uppercase
                                                           text-gray-500
                                                           lg:hidden">

                                                    Policy Title

                                                </label>


                                                <input id="policy-title-{{ $groupIndex }}-{{ $policyIndex }}"
                                                    type="text"
                                                    wire:model="groups.{{ $groupIndex }}.policies.{{ $policyIndex }}.title"
                                                    placeholder="Policy title"
                                                    class="w-full
                                                           rounded-md
                                                           border
                                                           border-gray-700
                                                           bg-gray-950
                                                           px-2.5 py-2
                                                           text-sm
                                                           text-white
                                                           placeholder:text-gray-600
                                                           focus:border-blue-500
                                                           focus:outline-none">


                                                @error("groups.$groupIndex.policies.$policyIndex.title")
                                                    <p
                                                        class="mt-1
                                                               text-xs
                                                               text-red-400">

                                                        {{ $message }}

                                                    </p>
                                                @enderror

                                            </div>



                                            {{-- Policy Controls --}}
                                            <div class="flex min-w-0 flex-nowrap gap-1 lg:justify-end">

                                                <a wire:click="movePolicyUp({{ $groupIndex }}, {{ $policyIndex }})"
                                                    @disabled($policyIndex === 0) title="Move Policy Up"
                                                    class="px-4 py-2
                                                        bg-slate-700 text-gray-100
                                                        rounded-md border border-green-500
                                                        hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                                        transition inline-block text-center
                                                           disabled:cursor-not-allowed
                                                           disabled:opacity-25">

                                                    ↑

                                                </a>

                                                <a wire:click="movePolicyDown({{ $groupIndex }}, {{ $policyIndex }})"
                                                    @disabled($policyIndex === count($group['policies']) - 1) title="Move Policy Down"
                                                    class="px-4 py-2
                                                        bg-slate-700 text-gray-100
                                                        rounded-md border border-green-500
                                                        hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                                        transition inline-block text-center
                                                           disabled:cursor-not-allowed
                                                           disabled:opacity-25">

                                                    ↓

                                                </a>

                                                <a wire:click="insertPolicy({{ $groupIndex }}, {{ $policyIndex }})"
                                                    title="Insert Policy Below"
                                                    class="px-4 py-2
                                                        bg-slate-700 text-gray-100
                                                        rounded-md border border-green-500
                                                        hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                                        transition inline-block text-center">
                                                    +
                                                </a>

                                                <a wire:click="removePolicy({{ $groupIndex }}, {{ $policyIndex }})"
                                                    wire:confirm="Are you sure you want to remove this policy?"
                                                    title="Remove Policy"
                                                    class="px-4 py-2
                                                        bg-slate-700 text-gray-100
                                                        rounded-md border border-red-500
                                                        hover:bg-slate-600 hover:border-red-400 cursor-pointer
                                                        transition inline-block text-center">
                                                    × </a>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>


                            {{-- Bottom Add Policy --}}
                            <div
                                class="border-t
                                       border-gray-800
                                       bg-gray-800/20
                                       px-4 py-2.5">

                                <a wire:click="addPolicy({{ $groupIndex }})"
                                    class="px-4 py-2
                                        bg-slate-700 text-gray-100
                                        rounded-md border border-green-500
                                        hover:bg-slate-600 hover:border-green-400 cursor-pointer
                                        transition inline-block text-center">

                                    + Add another policy

                                </a>

                            </div>

                        </section>
                    @endforeach



                    {{-- Bottom Add Group --}}
                    <a wire:click="addGroup"
                        class="px-4 py-2
                            bg-slate-700 text-gray-100
                            rounded-md border border-green-500
                            hover:bg-slate-600 hover:border-green-400 cursor-pointer
                            transition block text-center">

                        + Add Another Group

                    </a>

                </div>



                {{-- ===================================================== --}}
                {{-- FORM ACTIONS --}}
                {{-- ===================================================== --}}

                <div
                    class="flex items-center
                           justify-between
                           border-t
                           border-gray-700
                           pt-5">


                    <a href="{{ route('training.admin.modules.dashboard') }}"
                        class="px-4 py-2
                            bg-slate-700 text-gray-100
                            rounded-md border border-blue-500
                            hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                            transition inline-block text-center">

                        Cancel

                    </a>

                    <button type="submit" wire:loading.attr="disabled" wire:target="save"
                        class="!px-4 !py-2 !mb-3
                            !bg-slate-700
                            !rounded-md !border !border-green-400
                            hover:!bg-slate-600 hover:!border-green-300
                            !cursor-pointer !transition !inline-block !text-center">

                        <span wire:loading.remove wire:target="save">
                            {{ $checklistId ? 'Save Changes' : 'Create SOP Checklist' }}
                        </span>

                        <span wire:loading wire:target="save">
                            Saving...
                        </span>

                    </button>

                </div>

            </main>

        </div>

    </form>

</div>
