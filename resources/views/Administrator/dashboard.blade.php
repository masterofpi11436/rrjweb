@extends('layouts.administrator')

@section('title', 'App/User Dashboard')

@section('heading', 'Applications and Users Management')

@section('content')

<!-- Link to navigate to the Phone Directory App -->
<a href="{{ route('phone.dashboard') }}">Phone Directory</a>

<!-- Link to navigate to the Inmate Tablet App -->
<a href="{{ route('tablet.dashboard') }}">Inmate Tablets</a>

@endsection