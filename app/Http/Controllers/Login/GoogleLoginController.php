<?php

namespace App\Http\Controllers\Login;

use App\Models\Login\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

abstract class GoogleLoginController extends BaseLoginController
{
    // Redirects to google
    public function googleLogin()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Authenitcates the user through the google account
    public function googleAuthentication()
    {
        // Get the user's google information
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Check if the email is the same as google
        $user = $this->checkEmailExists($googleUser->email);

        // If the user is not found, redirect to login with an error
        if (!$user) {
            return redirect()->route($this->loginRoute())->withErrors(['email_not_found' => 'Your Google account is not associated with this application.']);
        }

        // Attempt to log the user in, ensuring they have the necessary admin access
        return $this->attemptLoginUsingGoogle($user, $this->dashboardRoute(), function ($user) {
            return $this->checkUserRole($user);
        });
    }

    protected function attemptLoginUsingGoogle($user, $redirectRoute, $roleCheck)
    {
        // Check if the user has access (admin == 1 or specific role)
        if ($user->admin == 1 || $roleCheck($user)) {
            Auth::login($user);
            session()->put('session_start_time', time());

            // Redirect to the application-specific dashboard route
            return redirect()->route($redirectRoute);
        }

        // If not authorized, log them out and redirect to the application's login page with an error
        Auth::logout();
        return redirect()->route($this->loginRoute())->withErrors(['email' => 'You are not authorized to access this application.']);
    }

    // Abstract methods to be implemented by each child class
    abstract protected function loginRoute();
    abstract protected function dashboardRoute();
    abstract protected function checkUserRole($user);
}
