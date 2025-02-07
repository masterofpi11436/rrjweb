<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class VFMTechLoginController extends BaseLoginController
{
    public function VFMTechLoginForm()
    {
        return view('Login.Logins.vfm-tech-login');
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
            return redirect()->route('vfm-tech.login')->withErrors(['email_not_found' => 'No account found with this email address.']);
        }

        // Attempt login with vfm access or admin access
        return $this->attemptLogin($request, 'vfm-tech.dashboard', function ($user) {
            return $user->vfm_tech == 1 || $user->admin == 1;
        });
    }

    public function vfmTechForgotPasswordForm()
    {
        return parent::showForgotPasswordForm('Login.Forgots.vfm-tech-forgot-password');
    }

    public function logout(Request $request, $route = 'vfm-tech.login')
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
