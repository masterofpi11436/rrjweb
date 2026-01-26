@extends('layouts.policy')

@section('title', 'Upload Policy')

@section('heading', 'Upload Policy')

@section('content')

<a href="{{ route('policy.dashboard') }}">Back</a>

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="policy-flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

<form action="{{ route('policy.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="pdfs">Upload PDFs</label>
        <input type="file" name="pdfs[]" id="pdfs" accept="application/pdf" multiple required>
    </div>
    <button>Upload</button>
</form>


@endsection
