<?php

namespace App\Http\Controllers\Login\Custom;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class TabletLoginController extends BaseLoginController
{
    public function tabletLoginForm()
    {
        return view('Login.Logins.tablet-login');
    }

    public function login(Request $request)
    {
        // Validate login input with ends_with directly in the login method
        $request->validate([
            'email' => 'required|email|ends_with:icsolutions.com,rrjva.org',
            'password' => 'required',
        ]);

        // Check if the email exists
        $user = $this->checkEmailExists($request->email);

        // If user is not found, return error
        if (!$user) {
            return redirect()->route('tablet.login')->withErrors(['email_not_found' => 'No account found with this email address.']);
        }

        // Attempt login with tablet access or admin access
        return $this->attemptLogin($request, 'tablet.dashboard', function ($user) {
            return $user->tablet == 1 || $user->admin == 1;
        });
    }

    public function tabletForgotPasswordForm()
    {
        return parent::showForgotPasswordForm('Login.Forgots.tablet-forgot-password');
    }

    public function logout(Request $request, $route = 'tablet.login')
    {
        // Perform the standard logout
        Auth::logout();

        // Invalidate the session to delete the cookie
        $request->session()->invalidate();
        Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        Cookie::queue(Cookie::forget('remember_token'));

        // Redirect to the specified route
        return redirect()->route($route);
    }
}
