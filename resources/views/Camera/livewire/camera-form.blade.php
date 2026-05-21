<form
    wire:submit.prevent="submitForm"
    class="max-w-4xl mx-auto bg-[#202b38] text-[#dbdbdb] border border-[#161f27] shadow-lg rounded-2xl p-8 space-y-6"
>

    <h2 class="text-2xl font-bold text-gray-800">
        {{ $cameraId ? 'Edit Camera' : 'Create Camera' }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Camera Number --}}
        <div>
            <label
                for="camera_number"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Camera Number
            </label>

            <input
                id="camera_number"
                type="text"
                wire:model.live="camera_number"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('camera_number')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Camera Name --}}
        <div>
            <label
                for="camera_name"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Camera Name
            </label>

            <input
                id="camera_name"
                type="text"
                wire:model.live="camera_name"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('camera_name')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Encoder Switch Location --}}
        <div>
            <label
                for="encoder_switch_location"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Encoder / Switch Location
            </label>

            <input
                id="encoder_switch_location"
                type="text"
                wire:model.live="encoder_switch_location"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('encoder_switch_location')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Encoder Switch Name --}}
        <div>
            <label
                for="encoder_switch_name"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Encoder / Switch Name
            </label>

            <input
                id="encoder_switch_name"
                type="text"
                wire:model.live="encoder_switch_name"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('encoder_switch_name')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Encoder Port --}}
        <div>
            <label
                for="encoder_port"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Encoder Port
            </label>

            <input
                id="encoder_port"
                type="text"
                wire:model.live="encoder_port"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('encoder_port')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Camera Model --}}
        <div>
            <label
                for="camera_model"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Camera Model
            </label>

            <input
                id="camera_model"
                type="text"
                wire:model.live="camera_model"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('camera_model')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- IP Address --}}
        <div>
            <label
                for="ip_address"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                IP Address
            </label>

            <input
                id="ip_address"
                type="text"
                wire:model.live="ip_address"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('ip_address')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Firmware Version --}}
        <div>
            <label
                for="firmware_version"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Firmware Version
            </label>

            <input
                id="firmware_version"
                type="text"
                wire:model.live="firmware_version"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('firmware_version')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Username --}}
        <div>
            <label
                for="credentials_username"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Username
            </label>

            <input
                id="credentials_username"
                type="text"
                wire:model.live="credentials.username"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('credentials.username')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div x-data="{ show: false }">
            <label
                for="credentials_password"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Password
            </label>

            <div class="flex items-center gap-2">

                <input
                    id="credentials_password"
                    :type="show ? 'text' : 'password'"
                    wire:model.live="credentials.password"
                    class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
                >

                <button
                    type="button"
                    x-on:click="show = !show"
                    class="px-3 py-2 rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] hover:border-[#41adff] transition"
                >
                    <span x-show="!show">👁</span>
                    <span x-show="show">🙈</span>
                </button>

            </div>

            @error('credentials.password')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- NVR --}}
        <div>
            <label
                for="NVR"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Storage NVR
            </label>

            <select
                id="NVR"
                wire:model.live="NVR"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >
                <option value="">Select NVR</option>

                @foreach(\App\Enums\CameraNVR::cases() as $type)
                    <option value="{{ $type->value }}">
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>

            @error('NVR')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Camera Type --}}
        <div>
            <label
                for="camera_type"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Camera Type
            </label>

            <select
                id="camera_type"
                wire:model.live="camera_type"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >
                <option value="">Select Type</option>

                @foreach(\App\Enums\CameraType::cases() as $type)
                    <option value="{{ $type->value }}">
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>

            @error('camera_type')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Location --}}
        <div>
            <label
                for="location"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Location
            </label>

            <input
                id="location"
                type="text"
                wire:model.live="location"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >

            @error('location')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label
                for="status"
                class="block text-sm font-medium text-[#dbdbdb] mb-1"
            >
                Status
            </label>

            <select
                id="status"
                wire:model.live="status"
                class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
            >
                <option value="">Select Status</option>

                @foreach(\App\Enums\CameraStatus::cases() as $type)
                    <option value="{{ $type->value }}">
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>

            @error('status')
                <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
            @enderror
        </div>

    </div>

    {{-- Notes --}}
    <div>
        <label
            for="notes"
            class="block text-sm font-medium text-[#dbdbdb] mb-1"
        >
            Notes
        </label>

        <textarea
            id="notes"
            wire:model.live="notes"
            rows="5"
            class="w-full rounded-lg bg-[#161f27] text-[#dbdbdb] border border-[#526980] px-4 py-2 placeholder-[#a9a9a9] focus:border-[#41adff] focus:ring focus:ring-[#41adff]/30 outline-none"
        ></textarea>

        @error('notes')
            <span class="text-sm text-[#ffbe85]">{{ $message }}</span>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="flex justify-end">
        <button
            type="submit"
            class="bg-[#1c7ed6] hover:bg-[#1864ab] text-white font-semibold px-6 py-3 rounded-xl shadow transition"
        >
            {{ $cameraId ? 'Update Camera' : 'Create Camera' }}
        </button>
    </div>

</form>
