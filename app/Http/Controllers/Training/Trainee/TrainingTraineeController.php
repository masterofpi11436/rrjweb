<?php

namespace App\Http\Controllers\Training\Trainee;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookAssignment;
use Illuminate\Support\Facades\Auth;

class TrainingTraineeController extends Controller
{
    public function dashboard()
    {
        $assignments = TrainingBookAssignment::with('book')
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->orderBy('assigned_at')
            ->get();

        return view('Training.Trainee.dashboard', compact('assignments'));
    }
}
