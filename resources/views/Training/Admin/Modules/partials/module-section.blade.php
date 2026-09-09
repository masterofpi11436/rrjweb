<section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900 shadow-sm">
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
                                        class="px-4 py-2 mb-4
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
                                                px-4 py-2 text-center text-sm font-medium
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
