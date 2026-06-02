<?php

namespace App\Models\Camera;

use App\Enums\CameraStatus;
use App\Enums\CameraType;
use App\Enums\CameraNVR;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;

    protected $table = 'camera_statuses';

    protected $fillable = [
        'camera_number',
        'camera_name',
        'encoder_switch_location',
        'encoder_switch_name',
        'encoder_port',
        'camera_model',
        'ip_address',
        'firmware_version',
        'credentials',
        'nvr',
        'notes',
        'camera_type',
        'location',
        'status',
    ];

    protected $casts = [
        'credentials' => 'array',
        'camera_type' => CameraType::class,
        'status' => CameraStatus::class,
        'nvr' => CameraNVR::class,
    ];
}
