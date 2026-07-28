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

        {{-- Content --}}
        <div>
            <label for="content" class="mb-2 block text-sm font-medium text-gray-200">
                Paragraph Content
            </label>

            <textarea id="content" wire:model="content" rows="10" placeholder="Enter the paragraph content"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"></textarea>

            @error('content')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Bullets --}}
        <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">
            <div
                class="flex flex-col gap-4 border-b border-gray-700 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-semibold text-white">
                        Paragraph Bullets
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Add optional bullet points to this paragraph module.
                    </p>
                </div>

                <button type="button" wire:click="addBullet"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-500">
                    Add Bullet
                </button>
            </div>

            @if (empty($bullets))
                <div class="px-5 py-8 text-center text-sm text-gray-400">
                    No bullet points have been added.
                </div>
            @else
                <div class="space-y-4 p-5">
                    @foreach ($bullets as $index => $bullet)
                        <div wire:key="paragraph-bullet-{{ $bullet['id'] ?? 'new' }}-{{ $index }}"
                            class="rounded-lg border border-gray-700 bg-gray-800/60 p-4">
                            <div class="grid gap-4 md:grid-cols-[180px_1fr_auto]">
                                <div>
                                    <label for="bullet-type-{{ $index }}"
                                        class="mb-2 block text-sm font-medium text-gray-200">
                                        Type
                                    </label>

                                    <select id="bullet-type-{{ $index }}"
                                        wire:model="bullets.{{ $index }}.type"
                                        class="w-full rounded-lg border border-gray-600 bg-gray-800 px-3 py-2 text-white">
                                        <option value="bullet">
                                            Bullet
                                        </option>

                                        <option value="ordered">
                                            Ordered List
                                        </option>
                                    </select>

                                    @error("bullets.$index.type")
                                        <p class="mt-2 text-sm text-red-400">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="bullet-text-{{ $index }}"
                                        class="mb-2 block text-sm font-medium text-gray-200">
                                        Text
                                    </label>

                                    <textarea id="bullet-text-{{ $index }}" wire:model="bullets.{{ $index }}.text" rows="3"
                                        class="w-full rounded-lg border border-gray-600 bg-gray-800 px-3 py-2 text-white"></textarea>

                                    @error("bullets.$index.text")
                                        <p class="mt-2 text-sm text-red-400">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="md:pt-7">
                                    <button type="button" wire:click="removeBullet({{ $index }})"
                                        wire:confirm="Remove this bullet?"
                                        class="rounded-lg border border-red-800 px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-950/50">
                                        Remove
                                    </button>
                                </div>
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
