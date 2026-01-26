@extends('layouts.Public.public')

@section('title', 'RRJ Policies')

@section('heading', 'RRJ Policies')

@section('content')

<div>
    <a href="https://rrjauthority.org/id/policy_directory.php" style="display: inline-block; padding: 0.5rem 1rem; background-color: #27559e; color: white; text-decoration: none; border-radius: 0.25rem;">
        Back to RRJ Information
    </a>
</div><br>

@livewire('policy.public-policy-search')

@endsection
