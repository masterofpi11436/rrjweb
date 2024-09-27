<div>

    <input type="text" wire:model.live="search" placeholder="Search directory..." class="form-control">

    @if ($suggestions->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Section</th>
                    <th>Extension</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $suggestion)
                    <tr>
                        <td>{{ $suggestion->name }}</td>
                        <td>{{ $suggestion->title }}</td>
                        <td>{{ $suggestion->section }}</td>
                        <td>{{ $suggestion->extension }}</td>
                        <td>
                            <a href="{{ route('PhoneDirectory.edit', $suggestion->id) }}">Edit</a>/
                            <a href="#" wire:click.prevent="delete({{ $suggestion->id }})" class="text-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No Record Found.</h1>
    @endif
</div>