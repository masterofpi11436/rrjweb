<?php

namespace App\Models\Tablet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    use HasFactory;

    protected $table = 'tablet';

    protected $fillable = ['inmate_number', 'last_name', 'first_name', 'middle_name', 'date_found',
                           'charged_101', 'filed_with_inmate_accounts', 'charged_by_inmate_accounts',
                           'payment_status', 'notes'];
}
