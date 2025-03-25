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
    <div class="fixed top-0 left-0 w-full bg-red-500 text-white text-center py-3 z-50">
        <p>You have opened this link in Microsoft Edge.</p>
        <p>This application is not supported in Microsoft Edge or Internet Explorer mode. Please use Chrome or Firefox.</p>
        <p>Please copy this web page's URL and paste it into the URL for Google Chrome or Firefox.</p>
        <p>IF you have any problems, please contact Mark in MIU at ext 6035.</p>
    </div>
@endif

@livewire('policy.public-policy-search')

@endsection
