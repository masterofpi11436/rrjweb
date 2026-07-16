<?php

namespace App\Http\Middleware\Auth\Training;

use App\Http\Middleware\Auth\BaseAuth;

class TrainingAdmin extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        // Check if the user is authenticated and is an admin
        return $user && ($user->training_role === 'admin' || $user->admin === 1);
    }

    protected function getRedirectRoute(): string
    {
        return 'training.login';
    }

    protected function getAccessDeniedMessage(): string
    {
        return 'You do not have access to this website. Please contact the Training Department for assistance.';
    }
}
