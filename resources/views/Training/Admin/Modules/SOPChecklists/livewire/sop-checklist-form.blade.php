<div class="space-y-6">

    <form wire:submit="save" class="space-y-6">

        {{-- Checklist Title --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-200">
                Checklist Title
            </label>

            <input id="title" type="text" wire:model="title"
                placeholder="Example: Standard Operating Procedure Acceptance and Acknowledgement"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white
                       placeholder:text-gray-500 focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-500/30">

            @error('title')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Description --}}
        <div>
            <label for="description" class="mb-2 block text-sm font-medium text-gray-200">
                Description
            </label>

            <textarea id="description" wire:model="description" rows="4" placeholder="Enter an optional description"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white
                       placeholder:text-gray-500 focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-500/30"></textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Policies --}}
        <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">

            <div
                class="flex flex-col gap-3 border-b border-gray-700 px-5 py-4
                       sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="font-semibold text-white">
                        SOP Policies
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Add the policies included in this SOP acknowledgement module.
                    </p>
                </div>

                <button type="button" wire:click="addPolicy"
                    class="inline-flex items-center justify-center rounded-lg
                           bg-blue-600 px-4 py-2 text-sm font-semibold
                           text-white hover:bg-blue-500">
                    Add Policy
                </button>

            </div>


            <div class="space-y-5 p-5">

                @error('policies')
                    <div
                        class="rounded-lg border border-red-700 bg-red-950/40
                               px-4 py-3 text-sm text-red-300">
                        {{ $message }}
                    </div>
                @enderror


                @foreach ($policies as $index => $policy)
                    <div wire:key="sop-policy-{{ $policy['id'] ?? 'new-' . $index }}"
                        class="overflow-hidden rounded-xl border
                               border-gray-700 bg-gray-800">

                        {{-- Header --}}
                        <div
                            class="flex flex-col gap-3 border-b border-gray-700
                                   px-4 py-3 sm:flex-row sm:items-center
                                   sm:justify-between">

                            <h3 class="font-medium text-white">
                                Policy {{ $index + 1 }}
                            </h3>

                            <div class="flex flex-wrap gap-2">

                                <button type="button" wire:click="movePolicyUp({{ $index }})"
                                    @disabled($index === 0)
                                    class="inline-flex items-center justify-center
                                           rounded-lg border border-gray-600
                                           px-3 py-2 text-xs font-medium
                                           text-gray-300 hover:bg-gray-700
                                           disabled:cursor-not-allowed
                                           disabled:opacity-40">
                                    Move Up
                                </button>

                                <button type="button" wire:click="movePolicyDown({{ $index }})"
                                    @disabled($index === count($policies) - 1)
                                    class="inline-flex items-center justify-center
                                           rounded-lg border border-gray-600
                                           px-3 py-2 text-xs font-medium
                                           text-gray-300 hover:bg-gray-700
                                           disabled:cursor-not-allowed
                                           disabled:opacity-40">
                                    Move Down
                                </button>

                                <button type="button" wire:click="insertPolicy({{ $index }})"
                                    class="inline-flex items-center justify-center
                                           rounded-lg border border-blue-700
                                           px-3 py-2 text-xs font-medium
                                           text-blue-300 hover:bg-blue-950/50">
                                    Insert Below
                                </button>

                                <button type="button" wire:click="removePolicy({{ $index }})"
                                    wire:confirm="Are you sure you want to remove this policy?"
                                    class="inline-flex items-center justify-center
                                           rounded-lg border border-red-700
                                           px-3 py-2 text-xs font-medium
                                           text-red-400 hover:bg-red-950/50">
                                    Remove
                                </button>

                            </div>

                        </div>


                        {{-- Fields --}}
                        <div class="space-y-5 p-4">

                            {{-- Category --}}
                            <div>
                                <label for="category-{{ $index }}"
                                    class="mb-2 block text-sm font-medium text-gray-200">
                                    Category
                                </label>

                                <select id="category-{{ $index }}"
                                    wire:model="policies.{{ $index }}.category"
                                    class="w-full rounded-lg border border-gray-600
                                        bg-gray-900 px-4 py-3 text-white
                                        focus:border-blue-500 focus:outline-none
                                        focus:ring-2 focus:ring-blue-500/30">
                                    <option value="">
                                        Select a Category
                                    </option>

                                    @foreach ($categories as $category)
                                        @if (!empty(trim($category['name'] ?? '')))
                                            <option value="{{ $category['name'] }}">
                                                {{ $category['name'] }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>

                                @error("policies.$index.category")
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-5 md:grid-cols-4">

                                {{-- Policy Number --}}
                                <div>
                                    <label for="policy-number-{{ $index }}"
                                        class="mb-2 block text-sm font-medium text-gray-200">
                                        Policy Number
                                    </label>

                                    <input id="policy-number-{{ $index }}" type="text"
                                        wire:model="policies.{{ $index }}.policy_number"
                                        placeholder="Example: 1.5"
                                        class="w-full rounded-lg border border-gray-600
                                               bg-gray-900 px-4 py-3 text-white
                                               placeholder:text-gray-500
                                               focus:border-blue-500 focus:outline-none
                                               focus:ring-2 focus:ring-blue-500/30">

                                    @error("policies.$index.policy_number")
                                        <p class="mt-2 text-sm text-red-400">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>


                                {{-- Policy Title --}}
                                <div class="md:col-span-3">
                                    <label for="policy-title-{{ $index }}"
                                        class="mb-2 block text-sm font-medium text-gray-200">
                                        Policy Title
                                    </label>

                                    <input id="policy-title-{{ $index }}" type="text"
                                        wire:model="policies.{{ $index }}.title"
                                        placeholder="Example: Office of Professional Review"
                                        class="w-full rounded-lg border border-gray-600
                                               bg-gray-900 px-4 py-3 text-white
                                               placeholder:text-gray-500
                                               focus:border-blue-500 focus:outline-none
                                               focus:ring-2 focus:ring-blue-500/30">

                                    @error("policies.$index.title")
                                        <p class="mt-2 text-sm text-red-400">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </section>

        {{-- Categories --}}
        <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">

            <div
                class="flex flex-col gap-3 border-b border-gray-700 px-5 py-4
               sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-semibold text-white">
                        Categories
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Create the categories that can be assigned to policies.
                    </p>
                </div>

                <button type="button" wire:click="addCategory"
                    class="inline-flex items-center justify-center rounded-lg
                   bg-blue-600 px-4 py-2 text-sm font-semibold
                   text-white hover:bg-blue-500">
                    Add Category
                </button>
            </div>

            <div class="space-y-4 p-5">

                @foreach ($categories as $index => $category)
                    <div wire:key="category-{{ $index }}" class="flex flex-col gap-3 sm:flex-row">

                        <div class="flex-1">

                            <input type="text" wire:model.blur="categories.{{ $index }}.name"
                                placeholder="Example: Administration/Management"
                                class="w-full rounded-lg border border-gray-600
                               bg-gray-800 px-4 py-3 text-white
                               placeholder:text-gray-500
                               focus:border-blue-500 focus:outline-none
                               focus:ring-2 focus:ring-blue-500/30">

                            @error("categories.$index.name")
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <button type="button" wire:click="removeCategory({{ $index }})"
                            class="inline-flex items-center justify-center rounded-lg
                           border border-red-700 px-4 py-3 text-sm
                           font-medium text-red-400 hover:bg-red-950/50">
                            Remove
                        </button>

                    </div>
                @endforeach

            </div>

        </section>

        {{-- Preview --}}
        <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">

            <div class="border-b border-gray-700 px-5 py-4">

                <h2 class="font-semibold text-white">
                    Checklist Preview
                </h2>

                <p class="mt-1 text-sm text-gray-400">
                    Policies will appear in this order.
                </p>

            </div>

            <div class="overflow-x-auto p-5">

                @php
                    $currentCategory = null;
                @endphp

                <table class="w-full text-left text-sm">

                    <tbody>

                        @foreach ($policies as $policy)
                            @if ($currentCategory !== $policy['category'])
                                @php
                                    $currentCategory = $policy['category'];
                                @endphp

                                <tr class="bg-gray-800">
                                    <td colspan="4"
                                        class="px-3 py-3 text-center font-semibold
                                               uppercase text-white">
                                        {{ $policy['category'] ?: 'Category' }}
                                    </td>
                                </tr>

                                <tr
                                    class="border-b border-gray-600 text-xs
                                           font-semibold uppercase text-gray-400">
                                    <th class="px-3 py-3">
                                        Policy No.
                                    </th>

                                    <th class="px-3 py-3">
                                        Title
                                    </th>

                                    <th class="px-3 py-3">
                                        Name
                                    </th>

                                    <th class="px-3 py-3">
                                        Date Completed
                                    </th>
                                </tr>
                            @endif


                            <tr class="border-b border-gray-700 text-gray-200">

                                <td class="px-3 py-3">
                                    {{ $policy['policy_number'] ?: '—' }}
                                </td>

                                <td class="px-3 py-3">
                                    {{ $policy['title'] ?: '—' }}
                                </td>

                                <td class="px-3 py-3 text-gray-500">
                                    —
                                </td>

                                <td class="px-3 py-3 text-gray-500">
                                    —
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </section>


        {{-- Actions --}}
        <div
            class="flex flex-col-reverse gap-3 border-t border-gray-700
                   pt-6 sm:flex-row sm:justify-end">

            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg
                       border border-gray-600 px-5 py-2.5 text-sm
                       font-medium text-gray-200 hover:bg-gray-800">
                Cancel
            </a>

            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="inline-flex items-center justify-center rounded-lg
                       bg-blue-600 px-5 py-2.5 text-sm font-semibold
                       text-white hover:bg-blue-500
                       disabled:cursor-not-allowed
                       disabled:opacity-50">

                <span wire:loading.remove wire:target="save">
                    {{ $checklistId ? 'Save Changes' : 'Create SOP Checklist' }}
                </span>

                <span wire:loading wire:target="save">
                    Saving...
                </span>

            </button>

        </div>

    </form>

</div>
