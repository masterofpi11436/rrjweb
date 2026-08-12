<div class="space-y-6">

    <form wire:submit="save" class="space-y-6">

        {{-- Test Information --}}
        <div class="rounded-lg border border-gray-700 bg-gray-800 p-6 shadow">

            <h2 class="mb-5 text-xl font-semibold text-white">
                Test Information
            </h2>

            <div class="space-y-5">

                {{-- Title --}}
                <div>
                    <label for="title" class="mb-1 block text-sm font-medium text-gray-300">
                        Title
                    </label>

                    <input type="text" id="title" wire:model="title"
                        class="w-full rounded-lg border border-gray-600 bg-gray-900 px-3 py-2 text-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">

                    @error('title')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="mb-1 block text-sm font-medium text-gray-300">
                        Description
                    </label>

                    <textarea id="description" wire:model="description" rows="3"
                        class="w-full rounded-lg border border-gray-600 bg-gray-900 px-3 py-2 text-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Passing Score --}}
                <div class="max-w-xs">
                    <label for="passing_score" class="mb-1 block text-sm font-medium text-gray-300">
                        Passing Score
                    </label>

                    <div class="flex items-center gap-2">
                        <input type="number" id="passing_score" wire:model="passing_score" min="0"
                            max="100"
                            class="w-full rounded-lg border border-gray-600 bg-gray-900 px-3 py-2 text-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">

                        <span class="text-gray-300">
                            %
                        </span>
                    </div>

                    @error('passing_score')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>


        {{-- Questions --}}
        <div class="space-y-5">

            @foreach ($questions as $questionIndex => $question)
                <div wire:key="question-{{ $question['id'] ?? 'new-' . $questionIndex }}"
                    class="rounded-lg border border-gray-700 bg-gray-800 p-6 shadow">

                    {{-- Question Header --}}
                    <div class="mb-5 flex items-center justify-between">

                        <h3 class="text-lg font-semibold text-white">
                            Question {{ $questionIndex + 1 }}
                        </h3>

                        @if (count($questions) > 1)
                            <button type="button" wire:click="removeQuestion({{ $questionIndex }})"
                                wire:confirm="Are you sure you want to remove this question?"
                                class="rounded-md bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700">
                                Remove Question
                            </button>
                        @endif

                    </div>


                    <div class="space-y-5">

                        {{-- Question Type --}}
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-300">
                                Question Type
                            </label>

                            <select wire:model.live="questions.{{ $questionIndex }}.type"
                                class="w-full rounded-lg border border-gray-600 bg-gray-900 px-3 py-2 text-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="multiple_choice">
                                    Multiple Choice
                                </option>

                                <option value="true_false">
                                    True / False
                                </option>

                                <option value="free_form">
                                    Free Form
                                </option>
                            </select>

                            @error("questions.{$questionIndex}.type")
                                <p class="mt-1 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Question --}}
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-300">
                                Question
                            </label>

                            <textarea wire:model="questions.{{ $questionIndex }}.question" rows="3" placeholder="Enter the question..."
                                class="w-full rounded-lg border border-gray-600 bg-gray-900 px-3 py-2 text-white placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>

                            @error("questions.{$questionIndex}.question")
                                <p class="mt-1 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Multiple Choice --}}
                        @if ($question['type'] === 'multiple_choice')
                            <div class="rounded-lg border border-gray-700 bg-gray-900/50 p-4">

                                <div class="mb-4 flex items-center justify-between">

                                    <div>
                                        <h4 class="font-medium text-white">
                                            Answer Options
                                        </h4>

                                        <p class="text-sm text-gray-400">
                                            Select the radio button beside the correct answer.
                                        </p>
                                    </div>

                                    <button type="button" wire:click="addOption({{ $questionIndex }})"
                                        class="rounded-md bg-gray-700 px-3 py-2 text-sm text-white hover:bg-gray-600">
                                        Add Answer
                                    </button>

                                </div>


                                <div class="space-y-3">

                                    @foreach ($question['options'] as $optionIndex => $option)
                                        <div wire:key="question-{{ $questionIndex }}-option-{{ $option['id'] ?? 'new-' . $optionIndex }}"
                                            class="flex items-center gap-3">

                                            {{-- Correct Answer --}}
                                            <input type="radio" name="correct-answer-{{ $questionIndex }}"
                                                wire:click="selectCorrectAnswer(
                                                    {{ $questionIndex }},
                                                    {{ $optionIndex }}
                                                )"
                                                @checked($option['is_correct'] ?? false) class="h-4 w-4">


                                            {{-- Option --}}
                                            <input type="text"
                                                wire:model="questions.{{ $questionIndex }}.options.{{ $optionIndex }}.option"
                                                placeholder="Answer {{ $optionIndex + 1 }}"
                                                class="flex-1 rounded-lg border border-gray-600 bg-gray-900 px-3 py-2 text-white placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">


                                            {{-- Remove --}}
                                            @if (count($question['options']) > 2)
                                                <button type="button"
                                                    wire:click="removeOption(
                                                        {{ $questionIndex }},
                                                        {{ $optionIndex }}
                                                    )"
                                                    class="rounded-md bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700">
                                                    Remove
                                                </button>
                                            @endif

                                        </div>

                                        @error("questions.{$questionIndex}.options.{$optionIndex}.option")
                                            <p class="ml-7 text-sm text-red-400">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    @endforeach

                                </div>

                                @error("questions.{$questionIndex}.options")
                                    <p class="mt-3 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>
                        @endif


                        {{-- True / False --}}
                        @if ($question['type'] === 'true_false')
                            <div class="rounded-lg border border-gray-700 bg-gray-900/50 p-4">

                                <h4 class="mb-1 font-medium text-white">
                                    Correct Answer
                                </h4>

                                <p class="mb-4 text-sm text-gray-400">
                                    Select whether the statement is true or false.
                                </p>


                                <div class="space-y-3">

                                    @foreach ($question['options'] as $optionIndex => $option)
                                        <label class="flex cursor-pointer items-center gap-3">

                                            <input type="radio" name="correct-answer-{{ $questionIndex }}"
                                                wire:click="selectCorrectAnswer(
                                                    {{ $questionIndex }},
                                                    {{ $optionIndex }}
                                                )"
                                                @checked($option['is_correct'] ?? false) class="h-4 w-4">

                                            <span class="text-white">
                                                {{ $option['option'] }}
                                            </span>

                                        </label>
                                    @endforeach

                                </div>

                                @error("questions.{$questionIndex}.options")
                                    <p class="mt-3 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>
                        @endif


                        {{-- Free Form --}}
                        @if ($question['type'] === 'free_form')
                            <div class="rounded-lg border border-gray-700 bg-gray-900/50 p-4">

                                <p class="text-sm text-gray-400">
                                    The trainee will be provided a text area to enter their answer.
                                    Free-form responses do not require an answer option.
                                </p>

                            </div>
                        @endif

                    </div>

                </div>
            @endforeach

        </div>


        {{-- Add Question --}}
        <div>
            <button type="button" wire:click="addQuestion"
                class="rounded-lg bg-gray-700 px-5 py-2.5 font-medium text-white hover:bg-gray-600">
                Add Question
            </button>
        </div>


        {{-- Save --}}
        <div class="flex justify-end border-t border-gray-700 pt-6">

            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50">
                <span wire:loading.remove wire:target="save">
                    {{ $testId ? 'Update Test' : 'Save Test' }}
                </span>

                <span wire:loading wire:target="save">
                    Saving...
                </span>
            </button>

        </div>

    </form>

</div>
