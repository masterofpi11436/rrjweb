<?php

namespace App\Http\Controllers\Login\Google;

use Laravel\Socialite\Facades\Socialite;

class TabletGoogleLoginController extends GoogleLoginController
{
    public function googleLogin()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirectUrl('http://localhost:8000/phone/google-callback')
            ->redirect();
    }

    protected function loginRoute()
    {
        return 'tablet.login';
    }

    protected function dashboardRoute()
    {
        return 'tablet.dashboard';
    }

    protected function checkUserRole($user)
    {
        return $user->tablet == 1 || $user->admin == 1;
    }
}
