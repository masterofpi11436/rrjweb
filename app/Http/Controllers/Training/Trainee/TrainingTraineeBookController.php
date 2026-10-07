<?php

namespace App\Http\Controllers\Training\Trainee;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookAssignment;
use App\Models\Training\TrainingBookPartModule;
use Illuminate\Support\Facades\Auth;

class TrainingTraineeBookController extends Controller
{
    public function index()
    {
        $assignments = TrainingBookAssignment::with('book')
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->orderByDesc('assigned_at')
            ->get();

        return view(
            'Training.Trainee.Book.index',
            compact('assignments')
        );
    }

    public function show(TrainingBookAssignment $assignment)
    {
        abort_unless(
            $assignment->user_id === Auth::id(),
            403
        );

        $assignment->load([
            'book.parts.modules.module',
            'modules',
        ]);

        return view('Training.Trainee.Book.show', [
            'assignment' => $assignment,
            'book' => $assignment->book,
        ]);
    }

    public function showModule(TrainingBookAssignment $assignment, TrainingBookPartModule $bookModule) {

        abort_unless(
            $assignment->user_id === Auth::id(),
            403
        );


        abort_unless(
            $bookModule->bookPart->book_id === $assignment->book_id,
            404
        );

        $bookModule->load('module');

        return view('Training.Trainee.Book.show-module', [
            'assignment' => $assignment,
            'bookModule' => $bookModule,
            'module' => $bookModule->module,
        ]);
    }

    public function completed()
    {
        $assignments = TrainingBookAssignment::with('book')
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->orderByDesc('updated_at')
            ->get();

        return view(
            'Training.Trainee.Book.completed',
            compact('assignments')
        );
    }
}
