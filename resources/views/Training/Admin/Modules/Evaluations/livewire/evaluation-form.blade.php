<div class="space-y-6">

    <form wire:submit="save" class="space-y-6">

        {{-- Evaluation Title --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-200">
                Evaluation Title
            </label>

            <input id="title" type="text" wire:model="title" placeholder="Enter the evaluation title"
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
                Instructions / Description
            </label>

            <textarea id="description" wire:model="description" rows="5"
                placeholder="Enter optional instructions for this evaluation"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white
                       placeholder:text-gray-500 focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-500/30"></textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>


        {{-- Evaluation Preview --}}
        <section class="rounded-xl border border-gray-700 bg-gray-900 p-5">

            <h2 class="mb-2 font-semibold text-white">
                Evaluation Fields
            </h2>

            <p class="mb-5 text-sm text-gray-400">
                These fields will be completed when this evaluation is assigned
                to a trainee.
            </p>

            <div class="space-y-5">

                <div>
                    <label class="mb-2 block font-semibold text-gray-200">
                        Strengths
                    </label>

                    <div class="h-24 rounded-lg border border-dashed border-gray-600 bg-gray-800"></div>
                </div>

                <div>
                    <label class="mb-2 block font-semibold text-gray-200">
                        Weaknesses
                    </label>

                    <div class="h-24 rounded-lg border border-dashed border-gray-600 bg-gray-800"></div>
                </div>

                <div>
                    <label class="mb-2 block font-semibold text-gray-200">
                        Areas of Improvement
                    </label>

                    <div class="h-24 rounded-lg border border-dashed border-gray-600 bg-gray-800"></div>
                </div>

            </div>

        </section>


        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-700 pt-6 sm:flex-row sm:justify-end">

            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-600
                       px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-gray-800">
                Cancel
            </a>

            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600
                       px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-500
                       disabled:cursor-not-allowed disabled:opacity-50">
                <span wire:loading.remove wire:target="save">
                    {{ $evaluationId ? 'Save Changes' : 'Create Evaluation' }}
                </span>

                <span wire:loading wire:target="save">
                    Saving...
                </span>
            </button>

        </div>

    </form>

</div>
