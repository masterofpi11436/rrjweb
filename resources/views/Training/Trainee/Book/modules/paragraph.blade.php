<div class="space-y-6">

    @forelse ($module->sections as $section)

        <section class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">

            {{-- Section Heading --}}
            @if ($section->heading)
                <div class="border-b border-gray-800 bg-gray-800/50 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">
                        {{ $section->heading }}
                    </h3>
                </div>
            @endif

            {{-- Section Content --}}
            <div class="space-y-6 p-6">

                @forelse ($section->paragraphs as $paragraph)
                    <div class="space-y-4">

                        {{-- Paragraph Text --}}
                        @if ($paragraph->content)
                            <div class="text-base leading-7 text-gray-300">
                                {!! nl2br(e($paragraph->content)) !!}
                            </div>
                        @endif

                        {{-- Lists --}}
                        @if ($paragraph->lists->isNotEmpty())
                            <div class="space-y-4 pl-2">

                                @foreach ($paragraph->lists as $list)
                                    {{-- Numbered List --}}
                                    @if ($list->type === 'ordered')
                                        <ol class="list-decimal space-y-2 pl-6 text-gray-300">

                                            @foreach ($list->items as $item)
                                                <li class="pl-1 leading-7">
                                                    {{ $item->content }}
                                                </li>
                                            @endforeach

                                        </ol>

                                        {{-- Alphabetical List --}}
                                    @elseif ($list->type === 'alphabetical')
                                        <ol class="list-[upper-alpha] space-y-2 pl-6 text-gray-300">

                                            @foreach ($list->items as $item)
                                                <li class="pl-1 leading-7">
                                                    {{ $item->content }}
                                                </li>
                                            @endforeach

                                        </ol>

                                        {{-- Bullet List --}}
                                    @else
                                        <ul class="list-disc space-y-2 pl-6 text-gray-300">

                                            @foreach ($list->items as $item)
                                                <li class="pl-1 leading-7">
                                                    {{ $item->content }}
                                                </li>
                                            @endforeach

                                        </ul>
                                    @endif
                                @endforeach

                            </div>
                        @endif

                    </div>

                @empty

                    <p class="text-sm text-gray-400">
                        No content is available for this section.
                    </p>
                @endforelse

            </div>

        </section>

    @empty

        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

            <p class="text-sm text-gray-400">
                No training content is available.
            </p>

        </div>

    @endforelse

</div>
