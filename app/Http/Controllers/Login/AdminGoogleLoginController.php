<?php

namespace App\Http\Controllers\Login;

class AdminGoogleLoginController extends GoogleLoginController
{
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
