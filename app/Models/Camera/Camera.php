<?php

namespace App\Models\Camera;

use App\Enums\CameraStatus;
use App\Enums\CameraType;
use App\Models\Camera\CameraStatusHistory;
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
        'NVR',
        'notes',
        'camera_type',
        'location',
        'status',
    ];

    protected $casts = [
        'credentials' => 'array',
        'camera_type' => CameraType::class,
        'status' => CameraStatus::class,
    ];

    public function histories()
    {
        return $this->hasMany(CameraStatusHistory::class);
    }
}
