@extends('layouts.administrator')

@section('title', 'App/User Dashboard')

@section('heading', 'App and User Management')

@section('content')

<!-- Link to manage users -->
<form action="{{ route('admin.index') }}">
    <button>Application Users</button>
</form>

<!-- Link to navigate to the Phone Directory App -->
<form action="{{ route('phone.dashboard') }}">
    <button>Phone Directory</button>
</form>

<!-- Link to navigate to the Phone Directory App -->
<form action="{{ route('vfm.dashboard') }}">
    <button>Vehicle Fleet Maintenance (VFM) Tracker</button>
</form>

@endsection
