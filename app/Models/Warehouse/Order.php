<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Login\User;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'supervisor_id', 'section_id',
        'items', 'status_id', 'approved_denied_by',
        'approved_denied_at', 'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_denied_by');
    }
}
