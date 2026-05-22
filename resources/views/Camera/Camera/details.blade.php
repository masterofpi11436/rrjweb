@extends('layouts.camera')

@section('title', 'Camera Details')

@section('heading', 'Camera Details')

@section('content')

<a href="{{ route('camera.dashboard') }}">Back</a>

    <div class="max-w-4xl mx-auto space-y-4">

        <div class="bg-[#202b38] text-[#dbdbdb] border border-[#161f27] shadow-lg rounded-2xl p-8 space-y-6">

            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-[#dbdbdb]">
                        Camera Details
                    </h2>

                    <p class="text-sm text-[#a9a9a9] mt-1">
                        {{ $camera->camera_number }} - {{ $camera->camera_name }}
                    </p>
                </div>

                <a href="{{route('camera.edit', $camera->id)}}">Edit Camera Details</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @php
                    $details = [
                        'Camera Number' => $camera->camera_number,
                        'Camera Name' => $camera->camera_name,
                        'Encoder / Switch Location' => $camera->encoder_switch_location,
                        'Encoder / Switch Name' => $camera->encoder_switch_name,
                        'Encoder Port' => $camera->encoder_port ?? 'N/A',
                        'Camera Model' => $camera->camera_model ?? 'N/A',
                        'IP Address' => $camera->ip_address,
                        'Firmware Version' => $camera->firmware_version ?? 'N/A',
                        'NVR' => $camera->nvr?->label() ?? 'N/A',
                        'Camera Type' => $camera->camera_type?->label() ?? 'N/A',
                        'Location' => $camera->location ?? 'N/A',
                        'Status' => $camera->status?->label() ?? 'N/A',
                    ];
                @endphp

                @foreach ($details as $label => $value)
                    <div class="rounded-lg bg-[#161f27] border border-[#526980] px-4 py-3">
                        <p class="text-sm text-[#a9a9a9] mb-1">
                            {{ $label }}
                        </p>

                        <p class="font-semibold text-[#dbdbdb]">
                            {{ $value }}
                        </p>
                    </div>
                @endforeach

            </div>

            <div
                x-data="{ showCredentials: false }"
                class="rounded-lg bg-[#161f27] border border-[#526980] px-4 py-3"
            >
                <div class="flex items-center justify-between mb-3">

                    <p class="text-sm text-[#a9a9a9]">
                        Credentials
                    </p>

                    <button
                        type="button"
                        x-on:click="showCredentials = !showCredentials"
                        class="text-sm px-3 py-1 rounded-lg border border-[#526980] hover:border-[#41adff] text-[#dbdbdb] transition"
                    >
                        <span x-show="!showCredentials">
                            Show
                        </span>

                        <span x-show="showCredentials">
                            Hide
                        </span>
                    </button>

                </div>

                @if (is_array($camera->credentials))

                    <div class="space-y-2">

                        @foreach ($camera->credentials as $key => $value)

                            <div class="flex items-center justify-between gap-4">

                                <span class="font-semibold text-[#dbdbdb]">
                                    {{ ucfirst($key) }}:
                                </span>

                                <span class="text-[#dbdbdb] font-mono">

                                    {{-- Password Hidden --}}
                                    @if ($key === 'password')

                                        <span x-show="!showCredentials">
                                            ••••••••
                                        </span>

                                        <span x-show="showCredentials">
                                            {{ $value ?: 'N/A' }}
                                        </span>

                                    @else

                                        {{ $value ?: 'N/A' }}

                                    @endif

                                </span>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p class="font-semibold text-[#dbdbdb]">
                        {{ $camera->credentials ?? 'N/A' }}
                    </p>

                @endif
            </div>

            <div class="rounded-lg bg-[#161f27] border border-[#526980] px-4 py-3">
                <p class="text-sm text-[#a9a9a9] mb-2">
                    Notes
                </p>

                <p class="text-[#dbdbdb] whitespace-pre-line">
                    {{ $camera->notes ?? 'No notes available.' }}
                </p>
            </div>

            <div class="flex flex-col md:flex-row md:justify-between gap-2 text-sm text-[#a9a9a9] border-t border-[#526980] pt-4">
                <p>
                    Created:
                    {{ $camera->created_at?->format('m/d/Y h:i A') ?? 'N/A' }}
                </p>

                <p>
                    Last Updated:
                    {{ $camera->updated_at?->format('m/d/Y h:i A') ?? 'N/A' }}
                </p>
            </div>

        </div>

    </div>

@endsection