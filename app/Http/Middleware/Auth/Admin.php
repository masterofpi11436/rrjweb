<?php

namespace App\Http\Middleware\Auth;

class Admin extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        // Check if the user is authenticated and is an admin
        return $user && $user->admin === 1;
    }

    protected function getRedirectRoute(): string
    {
        return 'admin.login';
    }

    protected function getAccessDeniedMessage(): string
    {
        return 'You do not have access to admin pages.';
    }
}
