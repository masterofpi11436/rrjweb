<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class MailroomLoginController extends BaseLoginController
{
    public function mailroomLoginForm()
    {
        return view('Login.Logins.mailroom-login');
    }

    public function login(Request $request)
    {
        // Validate login input with ends_with directly in the login method
        $request->validate([
            'email' => 'required|email|ends_with:rrjva.org',
            'password' => 'required',
        ]);

        // Check if the email exists
        $user = $this->checkEmailExists($request->email);

        // If user is not found, return error
        if (!$user) {
            return redirect()->route('mailroom.login')->withErrors(['email_not_found' => 'No account found with this email address.']);
        }

        // Attempt login with mailroom access or admin access
        return $this->attemptLogin($request, 'mailroom.dashboard', function ($user) {
            return $user->mailroom == 1 || $user->admin == 1;
        });
    }

    public function mailroomForgotPasswordForm()
    {
        return parent::showForgotPasswordForm('Login.Forgots.mailroom-forgot-password');
    }

    public function logout(Request $request, $route = 'mailroom.login')
    {
        // Perform the standard logout
        Auth::logout();

        // Invalidate the session to delete the cookie
        $request->session()->invalidate();
        Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        Cookie::queue(Cookie::forget('remember_token'));

        // Redirect to the specified application
        return redirect()->route($route);
    }
}
