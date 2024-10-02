<?php

namespace App\Models\Login;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserApplicationRole extends Pivot
{
    use HasFactory;

    protected $table = 'user_application_role';

    protected $fillable = ['user_id', 'application_id', 'role_id'];
}