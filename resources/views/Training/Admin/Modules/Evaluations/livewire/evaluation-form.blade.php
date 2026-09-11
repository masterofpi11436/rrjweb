<div class="space-y-6">

    <form wire:submit="save" class="space-y-6">

        <section
            class="overflow-hidden rounded-lg
                   border border-gray-700
                   bg-gray-900">

            <div class="border-b border-gray-700
                       bg-gray-800 px-4 py-3">

                <h2 class="font-semibold text-white">
                    Evaluation Details
                </h2>

                <p class="mt-1 text-sm text-gray-400">
                    Basic information for this evaluation.
                </p>

            </div>

            <div class="space-y-4 p-4">

                {{-- Title --}}
                <div>

                    <label for="title"
                        class="mb-1.5 block
                               text-sm font-medium
                               text-gray-200">

                        Evaluation Title

                    </label>

                    <input id="title" type="text" wire:model="title" placeholder="Enter the evaluation title"
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
                        <p class="mt-1 text-sm text-red-400">
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

                        Instructions / Description

                    </label>

                    <textarea id="description" wire:model="description" rows="3"
                        placeholder="Enter optional instructions for this evaluation"
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
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </section>

        <section class="overflow-hidden rounded-lg
           border border-gray-700
           bg-gray-900">

            {{-- Header --}}
            <div
                class="flex flex-wrap
               items-center
               justify-between
               gap-3
               border-b border-gray-700
               bg-gray-800
               px-4 py-3">

                <div>
                    <h2 class="font-semibold text-white">
                        Evaluation Fields
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Define the fields that will be completed during this evaluation.
                    </p>
                </div>

                <a wire:click="addField"
                    class="px-4 py-2
                        bg-slate-700 text-gray-100
                        rounded-md border border-blue-500
                        hover:bg-slate-600 hover:border-blue-400 cursor-pointer
                        transition inline-block text-center">

                    + Add Field

                </a>

            </div>


            {{-- Fields Validation --}}
            @error('fields')
                <div
                    class="m-4 rounded-md
                   border border-red-700
                   bg-red-950/40
                   px-4 py-3
                   text-sm text-red-300">

                    {{ $message }}

                </div>
            @enderror
            {{-- Desktop Headings --}}
            <div
                class="hidden
                    grid-cols-[40px_240px_170px_170px]
                    gap-4
                    border-b border-gray-800
                    bg-gray-950/30
                    px-4 py-2
                    text-xs font-semibold
                    uppercase tracking-wide
                    text-gray-500
                    md:grid">

                <div class="text-center">
                    #
                </div>

                <div>
                    Field Label
                </div>

                <div>
                    Field Type
                </div>

                <div>
                    Actions
                </div>

            </div>

            {{-- Fields --}}
            <div class="divide-y divide-gray-800">

                @foreach ($fields as $fieldIndex => $field)
                    <div wire:key="evaluation-field-{{ $field['id'] ?? 'new-' . $fieldIndex }}"
                        class="px-4 py-3 hover:bg-gray-800/30">

                        <div
                            class="grid grid-cols-1
                                gap-4
                                md:grid-cols-[40px_240px_170px_170px]
                                md:items-start">

                            {{-- Number --}}
                            <div class="flex items-center
                               md:justify-center">

                                <span
                                    class="flex h-8 w-8
                                   items-center
                                   justify-center
                                   rounded-md
                                   bg-gray-800
                                   text-xs font-semibold
                                   text-gray-400">

                                    {{ $fieldIndex + 1 }}

                                </span>

                            </div>

                            {{-- Field Label --}}
                            <div>

                                <label for="field-label-{{ $fieldIndex }}"
                                    class="mb-1 block
                                   text-xs font-medium
                                   uppercase
                                   text-gray-500
                                   md:hidden">

                                    Field Label

                                </label>

                                <input id="field-label-{{ $fieldIndex }}" type="text"
                                    wire:model="fields.{{ $fieldIndex }}.label" placeholder="Example: Strengths"
                                    class="w-full rounded-md
                                   border border-gray-700
                                   bg-gray-950
                                   px-2 py-1.5
                                   text-sm text-white
                                   placeholder:text-gray-600
                                   focus:border-blue-500
                                   focus:outline-none">

                                @error("fields.$fieldIndex.label")
                                    <p class="mt-1 text-xs text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Field Type --}}
                            <div>

                                <label for="field-type-{{ $fieldIndex }}"
                                    class="mb-1 block
                                   text-xs font-medium
                                   uppercase
                                   text-gray-500
                                   md:hidden">

                                    Field Type

                                </label>

                                <select id="field-type-{{ $fieldIndex }}"
                                    wire:model="fields.{{ $fieldIndex }}.type"
                                    class="w-full rounded-md
                                   border border-gray-700
                                   bg-gray-950
                                   px-2 py-1.5
                                   text-sm text-white
                                   focus:border-blue-500
                                   focus:outline-none">

                                    <option value="textarea">
                                        Text Area
                                    </option>

                                    <option value="text">
                                        Single Line
                                    </option>

                                </select>

                                @error("fields.$fieldIndex.type")
                                    <p class="mt-1 text-xs text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Actions --}}
                            <div class="flex flex-nowrap gap-2">

                                {{-- Move Up --}}
                                <a wire:click="moveFieldUp({{ $fieldIndex }})" @disabled($fieldIndex === 0)
                                    title="Move Field Up"
                                    class="flex h-8 w-8
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-md
                                   border border-blue-500
                                   text-gray-400
                                   hover:bg-blue-400 cursor-pointer
                                   disabled:cursor-not-allowed
                                   disabled:opacity-25">

                                    ↑

                                </a>


                                {{-- Move Down --}}
                                <a wire:click="moveFieldDown({{ $fieldIndex }})" @disabled($fieldIndex === count($fields) - 1)
                                    title="Move Field Down"
                                    class="flex h-8 w-8
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-md
                                   border border-blue-500
                                   text-gray-400
                                   hover:bg-blue-400 cursor-pointer
                                   disabled:cursor-not-allowed
                                   disabled:opacity-25">

                                    ↓

                                </a>


                                {{-- Insert --}}
                                <a type="button" wire:click="insertField({{ $fieldIndex }})"
                                    title="Insert Field Below"
                                    class="flex h-8 w-8
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-md
                                   border border-green-500 cursor-pointer
                                   text-blue-500
                                   hover:bg-green-400">

                                    +

                                </a>


                                {{-- Remove --}}
                                <a wire:click="removeField({{ $fieldIndex }})"
                                    wire:confirm="Are you sure you want to remove this evaluation field?"
                                    title="Remove Field"
                                    class="flex h-8 w-8
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-md
                                   border border-red-500 text-red-400 cursor-pointer
                                   hover:bg-red-400">

                                    ×

                                </a>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>


            {{-- Bottom Add Field --}}
            <div class="border-t border-gray-800
               bg-gray-800/20
               px-4 py-3">

                <a wire:click="addField"
                    class="px-4 py-2
                        bg-slate-700 text-gray-100
                        rounded-md border border-green-500
                        hover:bg-slate-600 hover:border-green-400 cursor-pointer
                        transition inline-block text-center">

                    + Add another evaluation field

                </a>

            </div>

        </section>

        <div class="flex items-center
           justify-between
           border-t border-gray-700
           pt-5">

            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="px-4 py-2
               bg-slate-700 text-gray-100
               rounded-md border border-blue-500
               hover:bg-slate-600 hover:border-blue-400
               cursor-pointer transition inline-block text-center">

                Cancel

            </a>

            <a wire:click="save" wire:loading.attr="disabled" wire:target="save"
                class="px-4 py-2
               bg-slate-700 text-gray-100
               rounded-md border border-green-500
               hover:bg-slate-600 hover:border-green-400
               cursor-pointer transition inline-flex items-center justify-center
               disabled:cursor-not-allowed disabled:opacity-50">

                <span wire:loading.remove wire:target="save">
                    {{ $evaluationId ? 'Save Changes' : 'Create Evaluation' }}
                </span>

                <span wire:loading wire:target="save">
                    Saving...
                </span>

            </a>

        </div>

    </form>

</div>
