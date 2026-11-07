<?php

namespace App\Models\CellFlow;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pod extends Model
{
    use HasFactory;

    protected $table = 'cellflow_pods';

    protected $fillable = [
        'housing_unit_id',
        'name',
        'description',
        'is_enabled',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function housingUnit(): BelongsTo
    {
        return $this->belongsTo(HousingUnit::class, 'housing_unit_id');
    }

    public function cells(): HasMany
    {
        return $this->hasMany(Cell::class, 'pod_id');
    }
}
