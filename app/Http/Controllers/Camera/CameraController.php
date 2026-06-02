<?php

namespace App\Http\Controllers\Camera;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Camera\Camera;

class CameraController extends Controller
{
    // Unprotected route for everyone to view the directory
    public function index()
    {
        return view('Camera.Camera.index');
    }

    public function stats()
    {
        $cameras = Camera::all();

        return view('Camera.Camera.stats', compact('cameras'));
    }

    // Login Required Pages
    public function dashboard()
    {
        return view('Camera.Camera.dashboard');
    }

    public function create()
    {
        return view('Camera.Camera.create');
    }

    public function edit($id)
    {
        $camera = Camera::findOrFail($id);
        return view('Camera.Camera.edit', ['camera' => $camera]);
    }

    public function details($id)
    {
        $camera = Camera::findOrFail($id);
        return view('Camera.Camera.details', ['camera' => $camera]);
    }

    // Future IP addresses
    public function future()
    {
        return view('Camera.Camera.future');
    }
}
