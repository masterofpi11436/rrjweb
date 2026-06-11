<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyDefinition extends Model
{
    use HasFactory;

    protected $table = 'policy_definitions';

    protected $fillable = [
        'policy_id',
        'word',
        'definition',
    ];

    public function policyBuilder()
    {
        return $this->belongsTo(PolicyBuilder::class, 'policy_id');
    }
}
