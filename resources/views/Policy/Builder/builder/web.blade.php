@extends('layouts.policy-builder')

@section('title', 'Policy Builder')

@section('heading', 'Policy Builder')

@section('content')

    <div class="min-h-screen bg-gray-200 py-8 print:bg-white print:py-0">

        <style>
            @page {
                size: letter;
                margin: 0;
            }

            @media print {
                body {
                    background: white !important;
                }
            }
        </style>

        {{-- COVER PAGE --}}
        <section
            class="mx-auto mb-8 min-h-[11in] w-[8.5in] bg-white p-[0.45in] text-black shadow-xl print:mb-0 print:break-after-page print:shadow-none">
            <div class="border-2 border-green-500 p-4 min-h-[10.1in]">

                <div class="grid grid-cols-[27%_73%] gap-4 text-[9pt] leading-tight">
                    <div>
                        <img src="{{ asset('images/rrj-logo.jpg') }}" class="w-[120px]" alt="RRJ Logo">
                    </div>

                    <div>
                        <div class="text-[14pt] font-bold">POLICY TITLE:</div>
                        <div class="text-[14pt] font-bold mb-4">{{ $policy->title }}</div>

                        <div class="text-[12pt] font-bold">POLICY STATEMENT:</div>
                        <div class="mb-4">{{ $policy->policy_statement }}</div>

                        <div class="text-[12pt] font-bold">PURPOSE STATEMENT:</div>
                        <div>{{ $policy->policy_purpose }}</div>
                    </div>
                </div>

                <div class="mt-4 text-[8.5pt] leading-tight">
                    <p><span class="font-bold uppercase">Standards:</span> {{ $policy->standards }}</p>
                    <p><span class="font-bold uppercase">American Correctional Association:</span>
                        {{ $policy->american_correctional_association }}</p>
                    <p><span class="font-bold uppercase">VA Board of Local and Regional Jails:</span>
                        {{ $policy->va_board_of_local_and_regional_jails }}</p>
                    <p><span class="font-bold uppercase">Prison Rape Elimination Act:</span>
                        {{ $policy->prison_rape_and_elimination_act }}</p>
                    <p><span class="font-bold uppercase">NCCHC:</span> {{ $policy->ncchc }}</p>
                </div>

                <div class="mt-4 text-[8.5pt] leading-tight">
                    <div class="font-bold uppercase">Policy Cross Reference:</div>
                    <div>{{ $policy->policy_cross_reference }}</div>
                </div>

                <div class="mt-4 text-[8.5pt] leading-tight">
                    <div class="font-bold uppercase">Forms:</div>
                    <div>{{ $policy->forms }}</div>
                </div>

                <div class="mt-4 text-[8.5pt] leading-tight">
                    <div class="font-bold uppercase">Policy Effective Date:</div>
                    <div>
                        {{ $policy->policy_effective_date ? \Carbon\Carbon::parse($policy->policy_effective_date)->format('m/d/y') : '' }}
                    </div>
                </div>

                <div class="mt-4 text-[8.5pt] font-bold uppercase">
                    Policy Review / Revision Date:
                </div>

                @php
                    $dates = $policy->policy_revision_dates ?? [];
                    $columns = 4;
                    $rowsNeeded = 7;
                @endphp

                <table class="mt-2 w-full border-collapse text-[9pt]">
                    <tr class="bg-green-600 text-white font-bold">
                        @for ($i = 0; $i < 4; $i++)
                            <td class="border border-green-400 px-2 py-1">Revision:</td>
                            <td class="border border-green-400 px-2 py-1">Date:</td>
                        @endfor
                    </tr>

                    @for ($row = 0; $row < $rowsNeeded; $row++)
                        <tr class="{{ $row % 2 === 0 ? 'bg-green-200' : 'bg-white' }}">
                            @for ($col = 0; $col < $columns; $col++)
                                @php
                                    $index = $col * $rowsNeeded + $row;
                                    $item = $dates[$index] ?? null;
                                @endphp

                                <td class="h-[22px] border border-green-400 px-2 py-1 font-bold">
                                    {{ $item['revision'] ?? '' }}
                                </td>
                                <td class="h-[22px] border border-green-400 px-2 py-1">
                                    {{ isset($item['date']) ? \Carbon\Carbon::parse($item['date'])->format('m/d/y') : '' }}
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </table>

                <div class="mt-5 text-[8pt] font-bold uppercase">Signatures:</div>

                <table class="mt-2 w-full border-collapse text-[8pt]">
                    <tr>
                        <td class="w-[24%] border border-black px-2 py-4 font-bold uppercase">Policy Owner:</td>
                        <td class="w-[24%] border border-black px-2 py-4 font-bold">{{ $policy->policy_owner }}</td>
                        <td class="w-[32%] border border-black px-2 py-4"></td>
                        <td class="w-[20%] border border-black px-2 py-4 font-bold">DATE:</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-2 py-4 font-bold uppercase">Policy Reviewer:</td>
                        <td class="border border-black px-2 py-4 font-bold">{{ $policy->policy_reviewer }}</td>
                        <td class="border border-black px-2 py-4"></td>
                        <td class="border border-black px-2 py-4 font-bold">DATE:</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-2 py-4 font-bold uppercase">Superintendent</td>
                        <td class="border border-black px-2 py-4 font-bold">{{ $policy->superintendent_approval }}</td>
                        <td class="border border-black px-2 py-4"></td>
                        <td class="border border-black px-2 py-4 font-bold">DATE:</td>
                    </tr>
                </table>
            </div>
        </section>

        {{-- TABLE OF CONTENTS --}}
        <section
            class="mx-auto mb-8 min-h-[11in] w-[8.5in] bg-white p-[0.75in] text-black shadow-xl print:mb-0 print:break-after-page print:shadow-none">
            <h1 class="mb-6 text-[13pt] font-bold">Table of Contents</h1>

            <div class="space-y-3 text-[11pt]">
                @foreach ($policy->chapters as $chapterIndex => $chapter)
                    <div>
                        <div class="grid grid-cols-[110px_1fr] font-bold">
                            <div>Chapter {{ $chapterIndex + 1 }} -</div>
                            <div>{{ $chapter->chapter_title }}</div>
                        </div>

                        @foreach ($chapter->sections as $sectionIndex => $section)
                            <div class="ml-[110px] grid grid-cols-[60px_1fr]">
                                <div>{{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}</div>
                                <div>{{ $section->section_title }}</div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>

        {{-- POLICY BODY --}}
        <section
            class="mx-auto mb-8 min-h-[11in] w-[8.5in] bg-white p-[0.75in] text-black shadow-xl print:mb-0 print:break-after-page print:shadow-none">
            @foreach ($policy->chapters as $chapterIndex => $chapter)
                <div class="{{ $chapterIndex > 0 ? 'mt-10' : '' }} break-inside-avoid">
                    <div class="grid grid-cols-[110px_1fr] text-[14pt] font-bold">
                        <div>Chapter {{ $chapterIndex + 1 }}</div>
                        <div>{{ $chapter->chapter_title }}</div>
                    </div>
                </div>

                @foreach ($chapter->sections as $sectionIndex => $section)
                    <div class="mt-8 break-inside-avoid">
                        <div class="grid grid-cols-[70px_1fr] text-[12pt] font-bold">
                            <div>{{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}</div>
                            <div>{{ $section->section_title }}</div>
                        </div>
                    </div>

                    <div class="mt-4 space-y-3 text-[11pt] leading-tight">
                        @foreach ($section->paragraphs as $paragraphIndex => $paragraph)
                            <div class="grid grid-cols-[95px_1fr] gap-3 break-inside-avoid">
                                <div class="text-right">
                                    {{ $chapterIndex + 1 }}.{{ $sectionIndex + 1 }}.{{ $paragraphIndex + 1 }}
                                </div>

                                <div class="text-justify">
                                    <div>{{ $paragraph->paragraph }}</div>

                                    @if ($paragraph->bullets->count())
                                        <div class="mt-2 space-y-1 pl-5">
                                            @foreach ($paragraph->bullets as $bullet)
                                                <div>
                                                    <span class="font-bold">•</span>
                                                    {{ $bullet->list['text'] ?? '' }}
                                                </div>

                                                @foreach ($bullet->bulletBullets as $childBullet)
                                                    <div class="pl-6">
                                                        o {{ $childBullet->list['text'] ?? '' }}
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endforeach
        </section>

        {{-- DEFINITIONS --}}
        @if ($policy->policyDefinitions->count())
            <section
                class="mx-auto mb-8 min-h-[11in] w-[8.5in] bg-white p-[0.75in] text-black shadow-xl print:mb-0 print:break-after-page print:shadow-none">
                <h1 class="mb-6 text-center text-[18pt] font-bold">DEFINITIONS</h1>

                <div class="space-y-1 text-[11pt] leading-tight">
                    @foreach ($policy->policyDefinitions as $definition)
                        <div>
                            <span class="text-[11.5pt] font-bold">{{ $definition->word }}</span>
                            - {{ $definition->definition }}
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- REFERENCES --}}
        @if ($policy->references->count())
            <section
                class="mx-auto mb-8 min-h-[11in] w-[8.5in] bg-white p-[0.75in] text-black shadow-xl print:mb-0 print:shadow-none">
                <h1 class="mb-6 text-center text-[18pt] font-bold">REFERENCES</h1>

                <div class="space-y-4 text-[11pt] leading-tight">
                    @foreach ($policy->references as $reference)
                        <div class="break-inside-avoid">
                            <div class="mb-1 text-[12pt] font-bold">
                                {{ $reference->reference_title }}
                            </div>

                            <div class="space-y-2">
                                @foreach ($reference->paragraphs as $paragraph)
                                    @if ($paragraph->aca_reference)
                                        <div class="grid grid-cols-[28%_72%] gap-4">
                                            <div class="font-bold">
                                                {{ $paragraph->aca_reference }}
                                            </div>

                                            <div class="text-justify">
                                                {{ $paragraph->paragraph }}

                                                @foreach ($paragraph->bullets as $bullet)
                                                    <div class="mt-1">
                                                        • {{ $bullet->list['text'] ?? '' }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        @if ($paragraph->paragraph)
                                            <div class="text-justify">
                                                {{ $paragraph->paragraph }}
                                            </div>
                                        @endif

                                        @foreach ($paragraph->bullets as $bullet)
                                            <div class="ml-5">
                                                • {{ $bullet->list['text'] ?? '' }}
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
@endsection
