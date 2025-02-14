<div>

    <input type="text" wire:model.live="search" placeholder="Search policies...">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('title')">
                            Title
                            @if ($sortColumn === 'title')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $policy)
                    <tr>
                        <td>
                            <a href="{{ asset('storage/' . $policy->pdf) }}{{ $search ? '#search=' . urlencode($search) : '' }}" target="_blank">
                                {{ $policy->title }}
                            </a>
                        </td>
                        <td>
                            <div>
                                <!-- Delete link -->
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $policy->id }});">Delete</a>
                                <form id="delete-form-{{ $policy->id }}" action="{{ route('policy.destroy', $policy->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!-- Custom Confirmation Modal -->
                                <div id="custom-confirmation-modal-{{ $policy->id }}" class="confirmation-modal" style="display: none;">
                                    <div class="modal-content">
                                        <p>Are you sure you want to delete this policy?</p>
                                        <button class="btn-confirm" onclick="deleteRecord({{ $policy->id }});">Yes, Delete</button>
                                        <button class="btn-cancel" onclick="hideModal({{ $policy->id }});">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Policy Found.</h1>
    @endif
</div>
