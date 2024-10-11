<?php

namespace App\Http\Controllers\Administrator;

// Required Models
use App\Models\Login\User;

// Base Controller
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    public function dashboard()
    {
        return view('Administrator.dashboard');
    }

    public function index()
    {
        $users = User::with(['applications', 'roles'])->get();
        return view('Administrator.Users.index', compact('users'));
    }
}
