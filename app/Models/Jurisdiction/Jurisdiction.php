<?php

namespace App\Models\Jurisdiction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurisdiction extends Model
{
    use HasFactory;

    protected $table = 'jurisdictions';

    protected $fillable = ['name'];

    public function timeLogs()
    {
        return $this->hasMany(JurisdictionTimeLog::class);
    }
}
