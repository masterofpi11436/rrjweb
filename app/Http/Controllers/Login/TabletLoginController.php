<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;

class TabletLoginController extends BaseLoginController
{
    public function tabletLoginForm()
    {
        return view('Login.logins.tablet-login');
    }

    public function login(Request $request)
    {
        // Validate login input
        $this->validateLogin($request);

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

    public function logout($route = 'tablet.login')
    {
        return parent::logout($route);
    }
}
