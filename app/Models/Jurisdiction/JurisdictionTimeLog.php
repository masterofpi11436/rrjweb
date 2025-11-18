<?php

namespace App\Models\Jurisdiction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurisdictionTimeLog extends Model
{
    use HasFactory;

    protected $table = 'jurisdiction_time_log';

    protected $fillable = [
        'jurisdiction_id',
        'department',
        'date_of_visit',
        'arrival_time',
        'booking_start',
        'booking_end',
        'departure_time',
        'magistrate_start',
        'magistrate_end',
        'nurse_start',
        'nurse_end',
        'officer_start',
        'officer_end',
        'inmate_count',
        'did_not_get_committed',
        'note',
    ];

    protected $casts = [
        'department' => 'boolean',
        'did_not_get_committed' => 'boolean',
    ];

    public function jurisdiction()
    {
        return $this->belongsTo(Jurisdiction::class);
    }
}
