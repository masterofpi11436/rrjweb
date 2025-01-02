<?php

namespace App\Models\Login;

use App\Models\Warehouse\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define mass-assignable fields
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'admin', 'phone', 'vfm', 'vfm-tech', 'ics', 'policy',
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
            case 'policy':
                return $this->policy;
            default:
                return false;
        }
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function supervisedOrders()
    {
        return $this->hasMany(Order::class, 'supervisor_id');
    }

    public function approvedOrders()
    {
        return $this->hasMany(Order::class, 'approved_denied_by');
    }
}
