<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;

class AdminLoginController extends BaseLoginController
{
    public function adminLoginForm()
    {
        return view('Login.admin-login');
    }

    public function login(Request $request)
    {
        // Validate login input
        $this->validateLogin($request);

        // Check if the email exists
        $user = $this->checkEmailExists($request->email);

        // If user is not found, return error
        if (!$user) {
            return redirect()->route('admin.login')->withErrors(['email_not_found' => 'No account found with this email address.']);
        }

        // Attempt login with admin access
        return $this->attemptLogin($request, 'admin.dashboard', function ($user) {
            return $user->admin == 1;
        });
    }

    public function logout($route = 'admin.login')
    {
        return parent::logout($route);
    }
}
