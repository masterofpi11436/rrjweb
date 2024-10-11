<?php

namespace App\Models\Login;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_application_role')
            ->withPivot('application_id')
            ->withTimestamps();
    }

    public function applications()
    {
        return $this->belongsToMany(Application::class, 'user_application_role')
            ->withPivot('role_id')
            ->withTimestamps();
    }
}
