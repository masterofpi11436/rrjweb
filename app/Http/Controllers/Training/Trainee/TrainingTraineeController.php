<?php

namespace App\Http\Controllers\Training\Trainee;

// Base Controller
use App\Http\Controllers\Controller;

class TrainingTraineeController extends Controller
{
    public function dashboard()
    {
        return view('Training.Trainee.dashboard');
    }
}
