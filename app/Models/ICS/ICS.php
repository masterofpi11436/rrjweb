<?php

namespace App\Models\ICS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICS extends Model
{
    use HasFactory;

    protected $table = 'ics';

    protected $fillable = ['inmate_number', 'last_name', 'first_name', 'middle_name', 'date_found',
                           'charged_101', 'filed_with_inmate_accounts', 'charged_by_inmate_accounts',
                           'payment_status', 'notes'];
}
