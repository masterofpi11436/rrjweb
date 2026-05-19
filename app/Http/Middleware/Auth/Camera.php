<?php

namespace App\Http\Middleware\Auth;

class Camera extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        // Check if the user is authenticated and has phone access or is an admin
        return $user && ($user->camera === 1 || $user->admin === 1);
    }

    protected function getRedirectRoute(): string
    {
        return 'camera.login';
    }

    protected function getAccessDeniedMessage(): string
    {
        return 'You do not have access to the phone directory admin site.';
    }
}
