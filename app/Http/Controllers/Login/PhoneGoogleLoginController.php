<?php

namespace App\Http\Controllers\Login;

class PhoneGoogleLoginController extends GoogleLoginController
{
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
