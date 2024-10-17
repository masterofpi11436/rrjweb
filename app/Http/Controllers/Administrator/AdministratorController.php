<?php

namespace App\Http\Controllers\Administrator;

// Required Models
use App\Models\Login\User;

// Base Controller
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    public function dashboard()
    {
        return view('Administrator.dashboard');
    }

    public function index()
    {
        return view('Administrator.Users.index');
    }

    // Create new entry
    public function create()
    {
        return view('Administrator.Users.create');
    }

    public function edit($id)
    {
        return view('Administrator.Users.edit', ['userId' => $id]);
    }
}
