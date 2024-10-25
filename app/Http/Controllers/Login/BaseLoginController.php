<?php

namespace App\Http\Controllers\Login;

use App\Models\Login\User;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
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
                // Store the session start time or expiration time in the session
                $request->session()->put('session_start_time', time());

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

    public function showForgotPasswordForm($viewName)
    {
        return view($viewName);
    }

    public function forgotPassword(Request $request)
    {
        // Validate the email field
        $request->validate([
            'email' => 'required|email',
        ]);

        // Get the number of failed attempts from the session (default to 0)
        $failedAttempts = session()->get('forgot_password_attempts', 0);

        // Check if the user with the provided email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Increment the failed attempts count
            $failedAttempts++;

            // Store the new count in the session
            session()->put('forgot_password_attempts', $failedAttempts);

            // If failed attempts exceed 3, show a different error message and reset the counter
            if ($failedAttempts > 3) {
                session()->forget('forgot_password_attempts'); // Reset the counter
                return redirect()->back()->withErrors(['email_not_found' => 'Your email is not found. Please contact the administrator.']);
            }

            // Otherwise, show the regular "email not found" message
            return redirect()->back()->withErrors(['email_not_found' => 'Email not found. Please check your email.']);
        }

        // Reset the failed attempts counter on successful email lookup
        session()->forget('forgot_password_attempts');

        // Generate a password reset token
        $token = Password::createToken($user);

        // Send the reset email
        Mail::to($user->email)->send(new PasswordResetMail($token));

        return redirect()->back()->with('status', 'Password reset email has been sent!');
    }

}
