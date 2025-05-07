<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyRecipients extends Model
{
    use HasFactory;

    protected $table = 'monthly_report_recipients';
}
