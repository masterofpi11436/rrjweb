@extends('layouts.vfm')

@section('title', 'VFM Tech')

@section('heading', 'Show Ticket')

@section('content')

<a href="{{ route('vfm-tech.dashboard') }}">Cancel</a>

<h1>Vehicle Information</h1>
<p>Make: {{ $VFM->vehicle_make }}</p>
<p>Model: {{ $VFM->vehicle_model }}</p>
<p>VIN: {{ $VFM->vehicle_vin }}</p>
<p>License PLate: {{ $VFM->vehicle_license_plate }}</p>
<p>Vehicle Year: {{ $VFM->vehicle_year }}</p>

@php
    $inspectionItems = [
        'air_filter' => 'Air Filter',
        'antifreeze' => 'Antifreeze',
        'battery' => 'Battery',
        'battery_booster' => 'Battery Booster',
        'belts' => 'Belts',
        'brake_fluid' => 'Brake Fluid',
        'brakes_front' => 'Brakes Front',
        'brakes_rear' => 'Brakes Rear',
        'detention_equipment' => 'Detention Equipment',
        'diagnostic_scan' => 'Diagnostic Scan',
        'engine_oil' => 'Engine Oil',
        'exhaust' => 'Exhaust',
        'hoses' => 'Hoses',
        'lights' => 'Lights',
        'mirrors' => 'Mirrors',
        'power_steering_fluid' => 'Power Steering Fluid',
        'safety_restraints' => 'Safety Restraints',
        'shocks_struts' => 'Shock/Struts',
        'tires' => 'Tires',
        'transmission_fluid' => 'Transmission Fluid',
        'vehicle_jump_starter' => 'Vehicle Jump Starter',
        'window_operation' => 'Window Operation',
        'washer_fluid' => 'Washer Fluid',
        'windshield' => 'Windshield',
        'wiper_blades' => 'Wiper Blades',
        'fire_extinguisher' => 'Fire Extinguisher'
    ];
@endphp

@foreach ($inspectionItems as $field => $label)
    @if ($VFM->$field)
        <div class="checkbox-item-disabled">
            <input type="checkbox" id="{{ $field }}" disabled checked>
            <label for="{{ $field }}">{{ $label }}</label>
        </div>
    @else
        <div class="checkbox-item">
            <input type="checkbox" id="{{ $field }}" disabled>
            <label for="{{ $field }}">{{ $label }}</label>
        </div>
    @endif
@endforeach

<br>
Description of Service:
<p>{{ $VFM->description_of_service }}</p>

@endsection
