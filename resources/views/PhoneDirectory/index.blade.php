@extends('layouts.app')

@section('title', 'Phone Directory')

@section('heading', 'Phone Directory')

@section('content')

<form method="GET" action="{{ route('PhoneDirectory.index') }}">
    <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search directory..." class="form-control">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

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
            @foreach ($extensions as $entry)
                <tr>
                    <td>{{ $entry->name }}</td>
                    <td>{{ $entry->title }}</td>
                    <td>{{ $entry->section }}</td>
                    <td>{{ $entry->extension }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection