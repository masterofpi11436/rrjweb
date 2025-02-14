@extends('layouts.policy')

@section('title', 'Upload Policy')

@section('heading', 'Upload Policy')

@section('content')

<a href="{{ route('policy.dashboard') }}">Back</a>

<form action="{{ route('policy.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="pdfs">Upload PDFs</label>
        <input type="file" name="pdfs[]" id="pdfs" accept="application/pdf" multiple required>
    </div>
    <button>Upload</button>
</form>


@endsection
