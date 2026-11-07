<?php

namespace App\Models\CellFlow;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    protected $table = 'cellflow_cells';

    protected $fillable = [
        'pod_id',
        'name',
        'description',
        'is_enabled',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function pod(): BelongsTo
    {
        return $this->belongsTo(Pod::class, 'pod_id');
    }
}
