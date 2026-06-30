<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'programs_tc_weekly_reports';

    protected $fillable = ['inmate_number', 'last_name', 'first_name', 'middle_name', 'date_found',
                           'is_reported', 'is_filed', 'is_charged', 'is_paid', 'note'];

    protected $casts = ['date_found' => 'date'];
}
