<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Login\User;
use App\Models\Training\TrainingBook;

class TrainingBookController extends Controller
{
    public function dashboard()
    {
        return view('Training.Admin.Books.dashboard');
    }

    public function create()
    {
        return view('Training.Admin.Books.create');
    }

    public function edit($id)
    {
        $book = User::findOrFail($id);
        return view('Training.Admin.Book.edit', ['book' => $book]);
    }

    // Delete an existing user
    public function destroy($id)
    {
        $book = TrainingBook::findOrFail($id);
        $book->delete();

        session()->flash('create-edit-delete-message', 'Book deleted successfully!');
        return redirect()->back();
    }
}
