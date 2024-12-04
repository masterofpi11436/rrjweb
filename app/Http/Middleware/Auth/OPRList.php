<?php

namespace App\Http\Middleware\Auth;

class OPRList extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        // Check if the user is authenticated and has oprList access or is an admin
        return $user && ($user->oprList === 1 || $user->admin === 1);
    }

    protected function getRedirectRoute(): string
    {
        return 'oprList.login';
    }

    protected function getAccessDeniedMessage(): string
    {
        return 'You do not have access to the OPR List admin pages.';
    }
}
