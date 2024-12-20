<?php

namespace App\Models\Login;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define mass-assignable fields
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'admin', 'phone', 'vfm', 'vfm-tech', 'ics',
    ];

    // Define fields hidden from serialization (e.g., in JSON responses)
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Helper methods for checking access to specific applications
    public function hasAccessTo($app)
    {
        switch ($app) {
            case 'admin':
                return $this->admin;
            case 'phone':
                return $this->phone;
            case 'vfm':
                return $this->vfm;
            case 'vfm_tech':
                return $this->vfm_tech;
            case 'ics':
                return $this->ics;
            default:
                return false;
        }
    }
}

