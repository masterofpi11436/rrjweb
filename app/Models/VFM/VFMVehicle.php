<?php

namespace App\Models\VFM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VFMVehicle extends Model
{
    use HasFactory;

    public $table = "vfm_vehicle";

    protected $fillable = [
        'license_plate',
        'vehicle_year',
        'make',
        'model',
        'vin',
    ];

    public function vfms()
    {
        return $this->hasMany(VFM::class, 'vfm_vehicle_id');
    }
}
