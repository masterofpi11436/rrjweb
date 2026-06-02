<?php

namespace App\Models\Camera;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraFutureIPAddress extends Model
{
    use HasFactory;

    protected $table = 'camera_future_ip_address';

    protected $fillable = [
        'camera_number',
        'future_ip_address',
        'is_used',
    ];
}
