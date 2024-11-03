<?php

namespace App\Http\Controllers\Login\Google;

use Laravel\Socialite\Facades\Socialite;

class PhoneGoogleLoginController extends GoogleLoginController
{
    public function googleLogin()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with(['state' => 'phone']) // Pass 'admin' as the application identifier
            ->redirect();
    }

    protected function loginRoute()
    {
        return 'phone.login';
    }

    protected function dashboardRoute()
    {
        return 'phone.dashboard';
    }

    protected function checkUserRole($user)
    {
        return $user->admin == 1 || $user->phone == 1;
    }
}
