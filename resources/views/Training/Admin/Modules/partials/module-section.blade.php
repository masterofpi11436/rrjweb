<section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900 shadow-sm">

    @if (session()->has('flashMessage'))
        <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 50);
        
        setTimeout(() => {
            show = false;
        }, 2000);" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-5 right-5 z-50 w-full max-w-md
               rounded-lg border border-green-600
               bg-gray-900 px-5 py-4 text-sm text-gray-200 shadow-lg">

            <div class="flex items-center justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-full bg-green-500/10 text-green-400">
                        ✓
                    </div>

                    <div>

                        <p class="font-semibold text-green-400">
                            Success
                        </p>

                        <p class="mt-0.5 text-gray-300">
                            {{ session('flashMessage') }}
                        </p>

                    </div>

                </div>

                <button type="button" @click="show = false"
                    class="!rounded-md !border-0 !bg-transparent
                       !px-2 !py-1 !text-xl !text-gray-400
                       hover:!bg-gray-800 hover:!text-white
                       !transition">
                    &times;
                </button>

            </div>

        </div>
    @endif

    <div class="flex flex-col gap-4 border-b border-gray-700 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-white">
                {{ $title }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ $description }}
            </p>
        </div>

        <a href="{{ $createRoute }}"
            class="px-4 py-2 mb-4
                bg-slate-700 text-gray-100
               rounded-md border border-slate-500
               hover:bg-slate-600 hover:border-slate-400
               transition inline-block text-center">
            Add Module
        </a>
    </div>

    @if ($modules->isEmpty())
        <div class="px-6 py-10 text-center">
            <p class="text-sm text-gray-400">
                {{ $emptyMessage }}
            </p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-300">
                            Title
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-300">
                            Contents
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-300">
                            Updated
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-300">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @foreach ($modules as $module)
                        <tr class="transition hover:bg-gray-800/70">
                            <td class="px-6 py-4">
                                <div class="font-medium text-white">
                                    {{ $module->title }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-300">
                                {{ $module->description ?? 'No summary available' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-400">
                                {{ $module->updated_at?->format('M j, Y') }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route($editRouteName, $module->id) }}"
                                        class="px-4 py-2 mb-4 mt-4
                                            bg-slate-700 text-gray-100
                                            rounded-md border border-slate-500
                                            hover:bg-slate-600 hover:border-slate-400
                                            transition inline-block text-center">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route($destroyRouteName, $module->id) }}"
                                        onsubmit="return confirm('Delete this module?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="!bg-red-700 !text-white !border-red-500
                                                cursor-pointer rounded-md border
                                                px-4 py-2 mt-4 text-center text-sm font-medium
                                                transition hover:!bg-red-600 hover:!border-red-400">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
