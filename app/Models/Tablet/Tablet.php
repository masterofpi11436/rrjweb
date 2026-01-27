<?php

namespace App\Models\Tablet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    use HasFactory;

    protected $table = 'tablet';

    protected $fillable = ['inmate_number', 'last_name', 'first_name', 'middle_name', 'date_found',
                           'is_reported', 'is_filed', 'is_charged', 'is_paid', 'notes'];

    protected $casts = ['date_found' => 'date'];
}
