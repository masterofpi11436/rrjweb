@extends('layouts.administrator')

@section('title', 'Intake Dashboard')

@section('heading', 'Petersburg Intakes')

@section('content')

<div class="mb-6">
        <form action="{{ route('intake.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="pdf" class="block mb-2">Upload PDF</label>
            <input id="pdf" name="pdf" type="file" accept="application/pdf" required>
            @error('pdf')
                <div style="color:#b91c1c; margin-top:.5rem;">{{ $message }}</div>
            @enderror

            <div class="mt-4">
                <button type="submit">Process</button>
            </div>
        </form>
    </div>

    @isset($matches)
        <div class="mt-6">
            <h3>Found {{ $count }} match{{ $count === 1 ? '' : 'es' }}:</h3>
            @if($count)
                <ul>
                    @foreach($matches as $m)
                        <li>{{ $m }}</li>
                    @endforeach
                </ul>
            @else
                <p>No 25-... numeric strings found.</p>
            @endif
        </div>
    @endisset

@endsection
