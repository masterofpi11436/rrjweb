<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyBuilder extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'policy_builders';

    protected $casts = [
        'policy_revision_dates' => 'array',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'policy_id')
            ->orderBy('sort_order');
    }
}