<?php

namespace App\Http\Middleware\Auth;

class Policy extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        // Check if the user is authenticated and is an admin
        return $user && ($user->policy === 1 || $user->admin === 1);
    }

    protected function getRedirectRoute(): string
    {
        return 'policy.login';
    }

    protected function getAccessDeniedMessage(): string
    {
        return 'You do not have access to policy admin pages.';
    }
}
