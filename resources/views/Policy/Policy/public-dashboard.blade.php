@extends('layouts.Public.public')

@section('title', 'RRJ Policies')

@section('heading', 'RRJ Policies')

@section('content')

@php
    $ua = request()->header('User-Agent');
    $isEdge = str_contains($ua, 'Edg') || str_contains($ua, 'Edge');
    $isIE = str_contains($ua, 'Trident') || str_contains($ua, 'MSIE');
@endphp

@if ($isEdge || $isIE)
    <div style="position: fixed; top: 0; left: 0; width: 100%; background-color: #ef4444; color: white; text-align: center; padding: 1rem; z-index: 9999;">
        <p style="font-weight: bold;">You have opened this link in Microsoft Edge.</p>
        <p>This application is not supported in Microsoft Edge or Internet Explorer mode.</p>
        <p>Please use Google Chrome or Firefox instead.</p>
        <p>Please copy this web page's URL and paste it into the URL bar for Google Chrome or Firefox.</p>
        <p style="margin-top: 0.5rem;">If you have any problems, please contact Mark in MIU at ext 6035.</p>
    </div>
    <div style="height: 150px;"></div>
@endif

@livewire('policy.public-policy-search')

@endsection
