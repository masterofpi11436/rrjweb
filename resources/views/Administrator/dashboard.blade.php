@extends('layouts.administrator')

@section('title', 'App/User Dashboard')

@section('heading', 'Applications and Users Management')

@section('content')

<!-- Link to navigate to the Phone Directory App -->
<form action="{{ route('phone.dashboard') }}">
    <button>Phone Directory</button>
</form>

<!-- Link to navigate to the Inmate Tablet App -->
<form action="{{ route('tablet.dashboard') }}">
    <button>Inmate Tablets</button>
</form>

@endsection