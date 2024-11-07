<?php

namespace App\Http\Controllers\Login\Custom;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AdminLoginController extends BaseLoginController
{
    public function adminLoginForm()
    {
        return view('Login.Logins.admin-login');
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
            return redirect()->route('admin.login')->withErrors(['email_not_found' => 'No account found with this email address.']);
        }

        // Attempt login with admin access
        return $this->attemptLogin($request, 'admin.dashboard', function ($user) {
            return $user->admin == 1;
        });
    }

    public function adminForgotPasswordForm()
    {
        return parent::showForgotPasswordForm('Login.Forgots.admin-forgot-password');
    }

    public function logout(Request $request, $route = 'admin.login')
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
