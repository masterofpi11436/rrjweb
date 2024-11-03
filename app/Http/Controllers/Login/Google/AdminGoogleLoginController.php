<?php

namespace App\Http\Controllers\Login\Google;

use Laravel\Socialite\Facades\Socialite;

class AdminGoogleLoginController extends GoogleLoginController
{
    public function googleLogin()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with(['state' => 'admin']) // Pass 'admin' as the application identifier
            ->redirect();
    }

    protected function loginRoute()
    {
        return 'admin.login';
    }

    protected function dashboardRoute()
    {
        return 'admin.dashboard';
    }

    protected function checkUserRole($user)
    {
        return $user->admin == 1;
    }
}
