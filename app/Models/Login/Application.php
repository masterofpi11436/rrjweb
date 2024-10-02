<?php

namespace App\Models\Login;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_application_role')
                    ->using(UserApplicationRole::class)
                    ->withPivot('role_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_application_role')
                    ->using(UserApplicationRole::class)
                    ->withPivot('user_id');
    }
}