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
        'revised' => 'boolean',
        'approved' => 'boolean',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'policy_id')->orderBy('sort_order');
    }

    public function references()
    {
        return $this->hasMany(Reference::class, 'policy_id')->orderBy('sort_order');
    }

    public function policyDefinitions()
    {
        return $this->hasMany(PolicyDefinition::class, 'policy_id');
    }
}
