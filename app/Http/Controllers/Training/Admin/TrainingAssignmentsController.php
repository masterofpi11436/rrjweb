<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;

class TrainingAssignmentsController extends Controller
{
    public function dashboard()
    {
        return view('Training.Admin.Assignments.dashboard');
    }

    public function create()
    {
        return view('Training.Admin.Assignments.create');
    }
}
