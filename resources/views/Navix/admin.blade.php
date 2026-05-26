@extends('layouts.navix')

@section('title', 'Navix')

@section('heading', 'Navix')

@section('content')

<div
    id="navix-container"

    data-models='@json($models)'

    data-camera-x="{{ $cameraX }}"
    data-camera-y="{{ $cameraY }}"
    data-camera-z="{{ $cameraZ }}"

    data-light-intensity="{{ $lightIntensity }}"

    data-background-color="{{ $backgroundColor }}"

    style="width:50vw;height:50vh;"
></div>

@endsection
