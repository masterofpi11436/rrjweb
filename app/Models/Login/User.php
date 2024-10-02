<?php

namespace App\Models\Login;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function applications()
    {
        return $this->belongsToMany(Application::class, 'user_application_role')
                    ->using(UserApplicationRole::class)
                    ->withPivot('role_id'); // Ensure 'role_id' is loaded from the pivot
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_application_role')
                    ->using(UserApplicationRole::class)
                    ->withPivot('application_id');
    }
}