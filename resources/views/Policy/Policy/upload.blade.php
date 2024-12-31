@extends('layouts.policy')

@section('title', 'Upload Policy')

@section('heading', 'Upload Policy')

@section('content')

<a href="{{ route('policy.dashboard') }}">Back</a>

<form action="{{ route('policy.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="pdf">Choose PDF:</label>
        <input type="file" name="pdf" id="pdf" accept="application/pdf" required>
    </div>
    <div>
        <button type="submit">Upload</button>
    </div>
</form>

@endsection
