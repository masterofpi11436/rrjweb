<?php

namespace App\Models\Camera;

use App\Enums\CameraStatus;
use App\Models\Login\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'camera_id',
        'old_status',
        'new_status',
        'notes',
        'changed_by',
    ];

    protected $casts = [
        'old_status' => CameraStatus::class,
        'new_status' => CameraStatus::class,
    ];

    public function camera()
    {
        return $this->belongsTo(Camera::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
