@extends('layouts.Public.public')

@section('title', 'RRJ Policies')

@section('heading', 'RRJ Policies')

@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ua = window.navigator.userAgent;
        const isEdge = ua.includes('Edg') || ua.includes('Edge');
        const isIEMode = ua.includes('Trident') || ua.includes('MSIE');

        if (isEdge || isIEMode) {
            const warning = document.createElement('div');
            warning.style.position = 'fixed';
            warning.style.top = '0';
            warning.style.left = '0';
            warning.style.width = '100%';
            warning.style.backgroundColor = '#f87171'; // Tailwind red-400
            warning.style.color = '#fff';
            warning.style.padding = '1rem';
            warning.style.zIndex = '9999';
            warning.style.textAlign = 'center';
            warning.innerText = 'This application is not supported in Microsoft Edge or Internet Explorer mode. Please use Chrome or Firefox. Please call Mark in MIU if you need Assistance';
            document.body.prepend(warning);
        }
    });
</script>


@livewire('policy.public-policy-search')

@endsection
