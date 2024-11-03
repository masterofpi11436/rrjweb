<?php

namespace App\Http\Controllers\Login\Google;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Login\Custom\BaseLoginController;

abstract class GoogleLoginController extends BaseLoginController
{
    // Redirects to google
    public function googleLogin()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function googleAuthentication()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Retrieve the application identifier from the state parameter
        $app = request()->query('state');

        // Check if the user exists in your database
        $user = $this->checkEmailExists($googleUser->email);

        if (!$user) {
            return redirect()->route($this->loginRoute())->withErrors(['email_not_found' => 'Your Google account is not associated with this application.']);
        }

        // Attempt to log the user in and redirect to the application-specific dashboard
        return $this->attemptLoginUsingGoogle($user, $app);
    }

    protected function attemptLoginUsingGoogle($user, $app)
    {
        if ($user->admin == 1 || $this->checkUserRole($user)) {
            Auth::login($user);
            session()->put('session_start_time', time());

            // Redirect to the specific application dashboard based on the app identifier
            $route = match ($app) {
                'admin' => 'admin.dashboard',
                'phone' => 'phone.dashboard',
                'tablet' => 'tablet.dashboard',
                default => 'default.dashboard' // Fallback route
            };

            return redirect()->route($route);
        }

        Auth::logout();
        return redirect()->route($this->loginRoute())->withErrors(['email' => 'You are not authorized to access this application.']);
    }

    // Abstract methods to be implemented by each child class
    abstract protected function loginRoute();
    abstract protected function dashboardRoute();
    abstract protected function checkUserRole($user);
}
