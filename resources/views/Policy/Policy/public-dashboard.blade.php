@extends('layouts.Public.public')

@section('title', 'RRJ Policies')

@section('heading', 'RRJ Policies')

@section('content')

<div>
    <a href="https://rrjauthority.org/id/policy_directory.php" style="display: inline-block; padding: 0.5rem 1rem; background-color: #27559e; color: white; text-decoration: none; border-radius: 0.25rem;">
        Back to RRJ Information
    </a>
</div><br>

@php
    $ua = request()->header('User-Agent');
    $isEdge = str_contains($ua, 'Edg') || str_contains($ua, 'Edge');
    $isIE = str_contains($ua, 'Trident') || str_contains($ua, 'MSIE');
@endphp

@if ($isEdge || $isIE)
    <div style="position: fixed; inset: 0; display: flex; align-items: center; justify-content: center; background-color: #ef4444; color: white; text-align: center; padding: 2rem; z-index: 9999;">
        <div>
            <p style="font-size: 40px; font-weight: bold;">You have opened this link in Microsoft Edge.</p>
            <p>This application is not supported in Microsoft Edge.</p>
            <p style="font-size: 40px;">Please open Google Chrome or Firefox and use this web address:</p>
            <p style="font-size: 30px;">http://rrjapps/policy-search</p>
            <p style="margin-top: 1rem;">If you have any problems, please contact Mark in MIU at ext 6035.</p>
        </div>
    </div>
@else
    @livewire('policy.public-policy-search')
@endif


@endsection
