<?php

namespace App\Models\Tablet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InmateTablet extends Model
{
    use HasFactory;

    protected $table = 'inmate_tablet';

    protected $fillable = ['inmate_number', 'last_name', 'first_name', 'middle_name', 'date_tablet_found', '101_incident_report_filed',
                           'is_filed_by_inmate_accounts', 'is_charged_by_inmate_accounts', 'is_payed', 'notes'];
}
