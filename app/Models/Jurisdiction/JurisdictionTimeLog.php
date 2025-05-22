<?php

namespace App\Models\Jurisdiction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurisdictionTimeLog extends Model
{
    use HasFactory;

    protected $table = 'jurisdictions';

    protected $fillable = ['name'];

    public function jurisdiction()
    {
        return $this->belongsTo(Jurisdiction::class);
    }
}
