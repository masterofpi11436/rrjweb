<?php

namespace App\Http\Controllers\Mailroom;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Mailroom\Mailroom;

class MailroomController extends Controller
{
    // Login Required Pages
    public function dashboard()
    {
        return view('Mailroom.mailroom.dashboard');
    }

    public function create()
    {
        return view('Mailroom.mailroom.create');
    }

    public function edit($id)
    {
        $mailroom = Mailroom::findOrFail($id);
        return view('Mailroom.mailroom.edit', ['mailroom' => $mailroom]);
    }

    public function destroy($id)
    {
        $mailroom = Mailroom::findOrFail($id);
        $mailroom->delete();

        session()->flash('create-edit-delete-message', 'Inamte deleted successfully!');
        return redirect()->back();
    }
}
