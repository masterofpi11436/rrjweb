<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;

class PhoneLoginController extends BaseLoginController
{
    public function phoneLoginForm()
    {
        return view('Login.logins.phone-login');
    }

    public function login(Request $request)
    {
        // Validate login input
        $this->validateLogin($request);

        // Check if the email exists
        $user = $this->checkEmailExists($request->email);

        // If user is not found, return error
        if (!$user) {
            return redirect()->route('phone.login')->withErrors(['email_not_found' => 'No account found with this email address.']);
        }

        // Attempt login with phone access or admin access
        return $this->attemptLogin($request, 'phone.dashboard', function ($user) {
            return $user->phone == 1 || $user->admin == 1;
        });
    }

    public function phoneForgotPasswordForm()
    {
        return parent::showForgotPasswordForm('Login.forgots.phone-forgot-password');
    }

    public function logout($route = 'phone.login')
    {
        return parent::logout($route);
    }
}
