<?php

namespace App\Models\VFM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VFM30 extends Model
{
    use HasFactory;

    public $table = "vfm_30";

    protected $fillable = [
        'date_in',
        'date_out',
        'state_inspection',
        'license_plate',
        'mileage',
        'vehicle_year',
        'make',
        'model',
        'vin',
        'maintenance_technician',
        'outside_service_required',
        'outside_service_po',
        'description_of_service'
    ];
}
