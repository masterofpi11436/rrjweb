<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;

class TrainingUserController extends Controller
{
    public function dashboard()
    {
        return view('Training.Admin.User.dashboard');
    }
}
