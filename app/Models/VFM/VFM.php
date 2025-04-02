<?php

namespace App\Models\VFM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VFM extends Model
{
    use HasFactory;

    public $table = "vfm";

    protected $fillable = [
        'date_in',
        'date_out',
        'state_inspection',
        'mileage',
        'maintenance_technician',
        'description_of_service'
    ];

    public function vehicle()
    {
        return $this->belongsTo(VFMVehicle::class, 'vfm_vehicle_id');
    }
}
