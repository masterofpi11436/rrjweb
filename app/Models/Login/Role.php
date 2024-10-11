<?php

namespace App\Models\Login;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'app_name', 'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_application_role')
            ->withPivot('application_id')
            ->withTimestamps();
    }

    public function applications()
    {
        return $this->belongsToMany(Application::class, 'user_application_role')
            ->withPivot('user_id')
            ->withTimestamps();
    }
}
