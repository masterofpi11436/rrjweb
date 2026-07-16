<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Login\BaseLoginController;

class TrainingLoginController extends BaseLoginController
{
    public function trainingLoginForm()
    {
        return view('Login.Logins.training-login');
    }

    public function login(Request $request)
    {
        // Validate login input with ends_with directly in the login method
        $request->validate([
            'email' => 'required|email|ends_with:rrjva.org,RRJVA.ORG',
            'password' => 'required',
        ]);

        // Check if the email exists
        $user = $this->checkEmailExists($request->email);

        // If user is not found, return error
        if (!$user) {
            return redirect()->route('training.login')->withErrors(['email_not_found' => 'No account found with this email address.
                                                                      Please contact the Training Department to create an account']);
        }

        // Attempt login using BaseLoginController method
        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();

            return $this->redirectTrainingUser(Auth::user());
        }

        // If login fails, redirect back with password error
        return redirect()->route('training.login')->withErrors(['password_incorrect' => 'Password is incorrect.']);
    }

    public function redirectTrainingUser($user)
    {
        switch ($user->training_role) {
            case 'admin':
                return redirect()->route('training.admin.dashboard');
            case 'director':
                return redirect()->route('training.director.dashboard');
            case 'unit':
                return redirect()->route('training.unit.dashboard');
            case 'supervisor':
                return redirect()->route('training.supervisor.dashboard');
            case 'sergeant':
                return redirect()->route('training.sergeant.dashboard');
            case 'fto':
                return redirect()->route('training.fto.dashboard');
            case 'trainee':
                return redirect()->route('training.trainee.dashboard');
            default:
                return redirect()->route('warehouse.login')->withErrors(
                    ['email' => 'Something is wrong with you account. Please contact MIU']);
        }
    }

    public function warehouseForgotPasswordForm()
    {
        return parent::showForgotPasswordForm('Login.Forgots.warehouse-store-forgot-password');
    }

    public function logout(Request $request, $route = 'warehouse.login')
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
