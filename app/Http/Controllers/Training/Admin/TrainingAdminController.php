<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;

class TrainingAdminController extends Controller
{
    public function dashboard()
    {
        return view('Training.Admin.dashboard');
    }
}
