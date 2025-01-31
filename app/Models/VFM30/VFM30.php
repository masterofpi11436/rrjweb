<?php

namespace App\Models\VFM30;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VFM30 extends Model
{
    use HasFactory;

    public $table = "vfm_30";

    protected $fillable = [
        'date_in', 'date_out', 'state_inspection', 'license_plate', 'mileage',
        'vehicle_year', 'make', 'model', 'vin', 'maintenance_technician',
        'description_of_service', 'outside_service_required', 'outside_service_po'
    ];
}
