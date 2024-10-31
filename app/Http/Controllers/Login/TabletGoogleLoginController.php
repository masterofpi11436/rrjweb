<?php

namespace App\Http\Controllers\Login;

class TabletGoogleLoginController extends GoogleLoginController
{
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
