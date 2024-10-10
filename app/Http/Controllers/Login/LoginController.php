<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Models\Login\Application;

// Base Controller
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Show the login form for a specific application.
     *
     * @param string $application_name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm($application_name)
    {
        return view('auth.login', ['application_name' => $application_name]);
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request, $application_name)
    {
        // Validate the request (email and password)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, retrieve the authenticated user
            $user = Auth::user();

            // Check if the user has access to the application and their role
            return $this->redirectToApplication($user, $application_name);
        }

        // If authentication fails, return with an error message
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        Session::flush(); // Clear the session

        return redirect('/login')->with('status', 'You have been logged out.');
    }

    /**
     * Redirect the user based on their role and the application they logged into.
     *
     * @param  \App\Models\User  $user
     * @param  string  $application_name
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToApplication($user, $application_name)
    {
        // Retrieve the application by name
        $application = Application::where('name', $application_name)->first();

        if (!$application) {
            // If the application does not exist, deny access
            Auth::logout();
            return redirect('/admin/login')->withErrors('Invalid application.');
        }

        // Check the user's role for this application
        $role = $user->applications()->where('application_id', $application->id)->first()->pivot->role_id;
        $roleName = $application->roles()->where('id', $role)->first()->name;

        // Redirect based on role and application
        if ($roleName == 'Manager') {
            return redirect('/' . $application_name . '/manager-dashboard');
        } elseif ($roleName == 'Supervisor') {
            return redirect('/' . $application_name . '/supervisor-dashboard');
        } elseif ($roleName == 'User') {
            return redirect('/' . $application_name . '/user-dashboard');
        } else {
            // Default role redirection
            return redirect('/' . $application_name . '/dashboard');
        }
    }
}
