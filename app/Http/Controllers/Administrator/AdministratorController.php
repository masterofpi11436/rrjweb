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

    public function index(Request $request)
    {
        $users = $this->searchUsers($request);

        return view('Administrator.Users.index', [
            'users' => $users,
            'search' => $request->input('search'),
        ]);
    }

    // Perform search by first name, last name, email, application or role.
    private function searchUsers(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            return User::where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhereHas('applications', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('roles', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orderBy('last_name')
                        ->get();
        }

        // If no search query, return all users ordered by last name
        return User::orderBy('last_name')->get();
    }
}
