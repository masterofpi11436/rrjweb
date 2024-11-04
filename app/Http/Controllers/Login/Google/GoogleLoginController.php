<?php

namespace App\Http\Controllers\Login\Google;

use App\Models\Login\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    // Redirects to Google with the application identifier as a state parameter
    public function googleLogin($app)
    {
        return Socialite::driver('google')
            ->stateless()
            ->with(['state' => $app, 'prompt' => 'login']) // Pass application identifier as state
            ->redirect();
    }

    // Handles the callback from Google
    public function googleAuthentication()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Retrieve the application identifier from the state parameter
        $app = request()->query('state');

        // Check if the user exists in your database
        $user = $this->checkEmailExists($googleUser->email);

        if (!$user) {
            return redirect()->route('login')->withErrors(['email_not_found' => 'Your Google account is not associated with this application.']);
        }

        // Attempt to log the user in and redirect to the application-specific dashboard
        return $this->attemptLoginUsingGoogle($user, $app);
    }

    protected function attemptLoginUsingGoogle($user, $app)
    {
        // Determine if the user has access to the selected application
        $hasAccess = match ($app) {
            'admin' => $user->admin == 1,
            'phone' => $user->phone == 1 || $user->admin == 1,
            'tablet' => $user->tablet == 1 || $user->admin == 1,
            default => false,
        };

        if ($hasAccess) {
            Auth::login($user);
            session()->put('session_start_time', time());

            // Redirect to the specific application dashboard based on app identifier
            $route = match ($app) {
                'admin' => 'admin.dashboard',
                'phone' => 'phone.dashboard',
                'tablet' => 'tablet.dashboard',
                default => 'default.dashboard'
            };

            return redirect()->route($route);
        }

        // Redirect to the application's login route with an error message if not authorized
        $loginRoute = match ($app) {
            'admin' => 'admin.login',
            'phone' => 'phone.login',
            'tablet' => 'tablet.login',
            default => 'login' // Fallback, ensure this route exists or adjust as needed
        };

        Auth::logout();
        return redirect()->route($loginRoute)->withErrors(['email' => 'You are not authorized to access this application.']);
    }

    protected function checkEmailExists($email)
    {
        // Custom logic to find the user by email
        return User::where('email', $email)->first();
    }
}
