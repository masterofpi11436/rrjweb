<?php

namespace App\Http\Middleware\Auth;

class Jurisdiction extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        // Check if the user is authenticated and is an admin
        return $user && ($user->jurisdiction === 1 || $user->admin === 1);
    }

    protected function getRedirectRoute(): string
    {
        return 'jurisdiction.login';
    }

    protected function getAccessDeniedMessage(): string
    {
        return 'You do not have access to jurisdiction admin pages.';
    }
}
