<div class="mx-auto max-w-4xl">

    <form wire:submit="save" class="space-y-6">

        <div class="rounded-lg border border-gray-700 bg-gray-800 p-6 shadow">

            <div class="mb-6">

                <h2 class="text-xl font-bold text-white">
                    Assign Training Book
                </h2>

                <p class="mt-1 text-sm text-gray-400">
                    Select a training user and the book they should complete.
                </p>

            </div>

            <div class="space-y-6">

                {{-- User --}}
                <div>

                    <label for="user_id" class="mb-2 block text-sm font-medium text-gray-200">User</label>

                    <select id="user_id" wire:model="user_id"
                        class="w-full rounded-lg border border-gray-600 bg-gray-900 px-4 py-3 text-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">

                        <option value="">
                            Select User
                        </option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->last_name }}, {{ $user->first_name }}

                                @if ($user->training_role)
                                    - {{ $user->training_role->label() }}
                                @endif
                            </option>
                        @endforeach

                    </select>

                    @error('user_id')
                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Book --}}
                <div>

                    <label for="book_id" class="mb-2 block text-sm font-medium text-gray-200">

                        Training Book

                    </label>

                    <select id="book_id" wire:model="book_id"
                        class="w-full rounded-lg border border-gray-600 bg-gray-900 px-4 py-3 text-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">

                        <option value="">
                            Select Training Book
                        </option>

                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">
                                {{ $book->title }}
                            </option>
                        @endforeach

                    </select>

                    @error('book_id')
                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Assigned Date --}}
                <div>

                    <label for="assigned_at" class="mb-2 block text-sm font-medium text-gray-200">

                        Assigned Date

                    </label>

                    <input id="assigned_at" type="date" wire:model="assigned_at"
                        class="w-full rounded-lg border border-gray-600 bg-gray-900 px-4 py-3 text-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">

                    @error('assigned_at')
                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            <div class="mt-8 flex items-center justify-between">

                <a href="{{ route('training.admin.assignments.dashboard') }}"
                    class="rounded-md border border-gray-600 bg-gray-700 px-5 py-2.5 text-white transition hover:bg-gray-600">

                    Cancel

                </a>


                <button type="submit" wire:loading.attr="disabled"
                    class="rounded-md border border-white bg-green-600 px-6 py-2.5 font-medium text-white transition hover:bg-green-700 disabled:cursor-not-allowed disabled:opacity-50">

                    <span wire:loading.remove>
                        Assign Book
                    </span>

                    <span wire:loading>
                        Assigning...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>
