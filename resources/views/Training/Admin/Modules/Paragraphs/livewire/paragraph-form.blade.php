<div class="space-y-6">
    <form wire:submit="save" class="space-y-6">

        {{-- Title --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-200">
                Paragraph Module Title
            </label>

            <input id="title" type="text" wire:model="title" placeholder="Enter a title for this paragraph module"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">

            @error('title')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="description" class="mb-2 block text-sm font-medium text-gray-200">
                Module Description
            </label>

            <textarea id="description" wire:model="description" rows="3" placeholder="Enter an optional description"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"></textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">
            <div
                class="flex flex-col gap-4 border-b border-gray-700 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-semibold text-white">
                        Module Paragraphs
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Add paragraphs in the order the trainee should read them.
                    </p>
                </div>

                <button type="button" wire:click="addParagraph"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500">
                    Add Paragraph
                </button>
            </div>

            @if (empty($paragraphs))
                <div class="px-5 py-8 text-center text-sm text-gray-400">
                    No paragraphs have been added.
                </div>
            @else
                <div class="space-y-6 p-5">
                    @foreach ($paragraphs as $paragraphIndex => $paragraph)
                        <div wire:key="paragraph-{{ $paragraph['id'] ?? 'new' }}-{{ $paragraphIndex }}"
                            class="rounded-xl border border-gray-700 bg-gray-800/60 p-5">

                            <div class="mb-5 flex items-center justify-between">
                                <h3 class="font-semibold text-white">
                                    Paragraph {{ $paragraphIndex + 1 }}
                                </h3>

                                <button type="button" wire:click="removeParagraph({{ $paragraphIndex }})"
                                    wire:confirm="Remove this paragraph?"
                                    class="rounded-lg border border-red-800 px-3 py-2 text-sm text-red-400 hover:bg-red-950/50">
                                    Remove Paragraph
                                </button>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-gray-200">
                                        Heading
                                    </label>

                                    <input type="text" wire:model="paragraphs.{{ $paragraphIndex }}.heading"
                                        placeholder="Optional paragraph heading"
                                        class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white">
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-gray-200">
                                        Content
                                    </label>

                                    <textarea wire:model="paragraphs.{{ $paragraphIndex }}.content" rows="6" placeholder="Enter the paragraph content"
                                        class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white"></textarea>
                                </div>

                                <section class="rounded-lg border border-gray-700">
                                    <div class="flex items-center justify-between border-b border-gray-700 px-4 py-3">
                                        <div>
                                            <h4 class="font-medium text-white">
                                                Lists
                                            </h4>

                                            <p class="text-sm text-gray-400">
                                                Add optional bullet or numbered lists.
                                            </p>
                                        </div>

                                        <button type="button" wire:click="addList({{ $paragraphIndex }})"
                                            class="rounded-lg bg-gray-700 px-3 py-2 text-sm text-white hover:bg-gray-600">
                                            Add List
                                        </button>
                                    </div>

                                    <div class="space-y-4 p-4">
                                        @foreach ($paragraph['lists'] ?? [] as $listIndex => $list)
                                            <div wire:key="paragraph-{{ $paragraphIndex }}-list-{{ $list['id'] ?? 'new' }}-{{ $listIndex }}"
                                                class="rounded-lg border border-gray-600 bg-gray-900/50 p-4">

                                                <div class="mb-4 flex items-end gap-4">
                                                    <div class="flex-1">
                                                        <label class="mb-2 block text-sm font-medium text-gray-200">
                                                            List Type
                                                        </label>

                                                        <select
                                                            wire:model="paragraphs.{{ $paragraphIndex }}.lists.{{ $listIndex }}.type"
                                                            class="w-full rounded-lg border border-gray-600 bg-gray-800 px-3 py-2 text-white">
                                                            <option value="bullet">
                                                                Bullet List
                                                            </option>

                                                            <option value="ordered">
                                                                Ordered List
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <button type="button"
                                                        wire:click="removeList({{ $paragraphIndex }}, {{ $listIndex }})"
                                                        wire:confirm="Remove this list?"
                                                        class="rounded-lg border border-red-800 px-3 py-2 text-sm text-red-400">
                                                        Remove List
                                                    </button>
                                                </div>

                                                <div class="space-y-3">
                                                    @foreach ($list['items'] ?? [] as $itemIndex => $item)
                                                        <div wire:key="paragraph-{{ $paragraphIndex }}-list-{{ $listIndex }}-item-{{ $item['id'] ?? 'new' }}-{{ $itemIndex }}"
                                                            class="flex items-start gap-3">

                                                            <div class="pt-3 text-sm text-gray-400">
                                                                {{ ($list['type'] ?? 'bullet') === 'ordered' ? $itemIndex + 1 . '.' : '•' }}
                                                            </div>

                                                            <textarea wire:model="paragraphs.{{ $paragraphIndex }}.lists.{{ $listIndex }}.items.{{ $itemIndex }}.content"
                                                                rows="2" class="flex-1 rounded-lg border border-gray-600 bg-gray-800 px-3 py-2 text-white"></textarea>

                                                            <button type="button"
                                                                wire:click="removeListItem(
                                                            {{ $paragraphIndex }},
                                                            {{ $listIndex }},
                                                            {{ $itemIndex }}
                                                        )"
                                                                class="mt-1 rounded-lg px-3 py-2 text-sm text-red-400 hover:bg-red-950/50">
                                                                Remove
                                                            </button>
                                                        </div>
                                                    @endforeach

                                                    <button type="button"
                                                        wire:click="addListItem({{ $paragraphIndex }}, {{ $listIndex }})"
                                                        class="text-sm font-medium text-blue-400 hover:text-blue-300">
                                                        Add List Item
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-700 pt-6 sm:flex-row sm:justify-end">
            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-gray-800">
                Cancel
            </a>

            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-500 disabled:opacity-50">
                <span wire:loading.remove wire:target="save">
                    {{ $paragraphId ? 'Save Changes' : 'Create Paragraph Module' }}
                </span>

                <span wire:loading wire:target="save">
                    Saving...
                </span>
            </button>
        </div>
    </form>
</div>
