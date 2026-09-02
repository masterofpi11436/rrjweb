<?php

namespace App\Http\Middleware\Auth\Training;

use App\Enums\TrainingUser;
use App\Http\Middleware\Auth\BaseAuth;

class TrainingAdmin extends BaseAuth
{
    protected function hasAccess($user): bool
    {
        return $user && ($user->admin === 1 || $user->training_role === TrainingUser::ADMIN);
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
