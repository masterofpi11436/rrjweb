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
                        <a href="#" wire:click.prevent="sortBy('date_tablet_found')">
                            Date Tablet Found
                            @if ($sortColumn === 'date_tablet_found')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('is_101_incident_report_filed')">
                            101 Incident Report Filed?
                            @if ($sortColumn === 'is_101_incident_report_filed')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('is_filed_by_inmate_accounts')">
                            Filed by Inmate Accounts?
                            @if ($sortColumn === 'is_filed_by_inmate_accounts')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('is_charged_by_inmate_accounts')">
                            Charged by Inmate Accounts?
                            @if ($sortColumn === 'is_charged_by_inmate_accounts')
                                @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('is_payed')">
                            Account Paid?
                            @if ($sortColumn === 'is_payed')
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
                @foreach ($suggestions as $tablet)
                    <tr>
                        <td>{{ $tablet->inmate_number }}</td>
                        <td>{{ $tablet->last_name }}</td>
                        <td>{{ $tablet->first_name }}</td>
                        <td>{{ $tablet->middle_name }}</td>
                        <td>{{ $tablet->date_tablet_found }}</td>
                        <td>{{ $tablet->is_101_incident_report_filed ? 'Yes' : 'No' }}</td>
                        <td>{{ $tablet->is_filed_by_inmate_accounts ? 'Yes' : 'No' }}</td>
                        <td>{{ $tablet->is_charged_by_inmate_accounts ? 'Yes' : 'No' }}</td>
                        <td>{{ $tablet->is_payed ? 'Yes' : 'No' }}</td>
                        <td>{{ $tablet->notes }}</td>
                        <td>
                            <a href="{{ route('tablet.edit', $tablet->id) }}">Edit</a>/
                            <div>
                                <!-- Delete link -->
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $tablet->id }});">Delete</a>
                                <form id="delete-form-{{ $tablet->id }}" action="{{ route('tablet.destroy', $tablet->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!-- Custom Confirmation Modal -->
                                <div id="custom-confirmation-modal-{{ $tablet->id }}" class="confirmation-modal" style="display: none;">
                                    <div class="modal-content">
                                        <p>Are you sure you want to delete this record?</p>
                                        <button class="btn-confirm" onclick="deleteRecord({{ $tablet->id }});">Yes, Delete</button>
                                        <button class="btn-cancel" onclick="hideModal({{ $tablet->id }});">Cancel</button>
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
