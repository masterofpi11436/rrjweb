<?php

namespace App\Models\Login;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApplicationRole extends Model
{
    use HasFactory;

    protected $table = 'user_application_role';

    protected $fillable = [
        'user_id', 'application_id', 'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
