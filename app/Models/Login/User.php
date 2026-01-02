<?php

namespace App\Models\Login;

use App\Models\Warehouse\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define mass-assignable fields
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'admin', 'phone', 'vfm', 'vfm-tech', 'ics', 'policy', 'warehouse_role', 'jurisdiction',
    ];

    // Define fields hidden from serialization (e.g., in JSON responses)
    protected $hidden = [
        'password', 'remember_token',
    ];

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
