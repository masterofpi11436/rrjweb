<?php

namespace App\Http\Middleware\Auth;

class Mailroom extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        // Check if the user is authenticated and has mailroom access or is an admin
        return $user && ($user->mailroom === 1 || $user->admin === 1);
    }

    protected function getRedirectRoute(): string
    {
        return 'mailroom.login';
    }

    protected function getAccessDeniedMessage(): string
    {
        return 'You do not have access to the mailroom admin site.';
    }
}
