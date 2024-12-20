<div>

    <input type="text" wire:model.live="search" placeholder="Search inmates...">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('inmate_number')">
                            Inmate Number
                            @if ($sortColumn === 'inmate_number')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('last_name')">
                            Last Name
                            @if ($sortColumn === 'last_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('first_name')">
                            First Name
                            @if ($sortColumn === 'first_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('middle_name')">
                            Middle Name
                            @if ($sortColumn === 'middle_name')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('date_found')">
                            Date Tablet Found
                            @if ($sortColumn === 'date_found')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('charged_101')">
                            Charged 101?
                            @if ($sortColumn === 'charged_101')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('filed_with_inmate_accounts')">
                            Filed with Inmate Accounts?
                            @if ($sortColumn === 'filed_with_inmate_accounts')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('charged_by_inmate_accounts')">
                            Charged by Inmate Accounts?
                            @if ($sortColumn === 'charged_by_inmate_accounts')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('payment_status')">
                            Payment Status
                            @if ($sortColumn === 'payment_status')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('notes')">
                            Notes
                            @if ($sortColumn === 'notes')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $ics)
                    <tr>
                        <td>{{ $ics->inmate_number }}</td>
                        <td>{{ $ics->last_name }}</td>
                        <td>{{ $ics->first_name }}</td>
                        <td>{{ $ics->middle_name }}</td>
                        <td>{{ $ics->date_found }}</td>
                        <td>{{ $ics->charged_101 ? '101 Charged' : 'No'}}</td>
                        <td>{{ $ics->filed_with_inmate_accounts ? 'Filed' : 'No' }}</td>
                        <td>{{ $ics->charged_by_inmate_accounts ? 'Charged' : 'No' }}</td>
                        <td>{{ $ics->payment_status ? 'Paid' : 'Owes $300' }}</td>
                        <td>{{ $ics->notes }}</td>
                        <td>
                            <a href="{{ route('ics.edit', $ics->id) }}">Edit</a>/
                            <div>
                                <!-- Delete link -->
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $ics->id }});">Delete</a>
                                <form id="delete-form-{{ $ics->id }}" action="{{ route('ics.destroy', $ics->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!-- Custom Confirmation Modal -->
                                <div id="custom-confirmation-modal-{{ $ics->id }}" class="confirmation-modal" style="display: none;">
                                    <div class="modal-content">
                                        <p>Are you sure you want to delete this inmate?</p>
                                        <button class="btn-confirm" onclick="deleteRecord({{ $ics->id }});">Yes, Delete</button>
                                        <button class="btn-cancel" onclick="hideModal({{ $ics->id }});">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Record Found.</h1>
    @endif
</div>
