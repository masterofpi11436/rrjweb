<?php

namespace App\Models\Camera;

use App\Enums\CameraStatus;
use App\Enums\CameraType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;

    protected $table = 'camera_statuses';

    protected $fillable = ['camera_number', 'camera_name', 'camera_type', 'location', 'status', 'encoder_switch_location', 'ip_address'];

    protected $casts = [
        'status' => CameraStatus::class,
        'camera_type' => CameraType::class,
    ];

    public function histories()
    {
        return $this->hasMany(CameraStatusHistory::class);
    }
}
