<?php

namespace App\Http\Controllers\Login;

use App\Models\Login\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BaseLoginController extends Controller
{
    public function validateLogin(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
    }

    public function checkEmailExists($email)
    {
        return User::where('email', $email)->first();
    }


    public function attemptLogin(Request $request, $redirectRoute, $roleCheck)
    {
        // Attempt to log in using email and password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if the user has the correct access or is an admin
            if ($roleCheck($user)) {
                // Redirect to the specific application dashboard
                return redirect()->route($redirectRoute);
            } else {
                // If not authorized, deny access
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'You are not authorized to access this application.']);
            }
        }

        // If password is incorrect, return back with password error
        return redirect()->back()->withErrors(['password_incorrect' => 'Password is incorrect.']);
    }

    public function logout($route = null)
    {
        Auth::logout();

        return redirect()->route($route);
    }
}
