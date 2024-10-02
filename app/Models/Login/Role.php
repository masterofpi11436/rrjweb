<?php

namespace App\Models\Login;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_application_role')
                    ->using(UserApplicationRole::class)
                    ->withPivot('application_id');
    }

    public function applications()
    {
        return $this->belongsToMany(Application::class, 'user_application_role')
                    ->using(UserApplicationRole::class)
                    ->withPivot('user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}