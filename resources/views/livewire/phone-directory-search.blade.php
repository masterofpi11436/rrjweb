<div>
    <!-- Use wire:model.live to immediately sync the input with the search term -->
    <input type="text" wire:model.live="search" placeholder="Search directory..." class="form-control">

    <!-- Suggestions list -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Title</th>
                <th>Section</th>
                <th>Extension</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suggestions as $suggestion)
                <tr>
                    <td>{{ $suggestion->name }}</td>
                    <td>{{ $suggestion->title }}</td>
                    <td>{{ $suggestion->section }}</td>
                    <td>{{ $suggestion->extension }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
