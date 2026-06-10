<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $table = 'policy_references';

    protected $fillable = [
        'policy_id',
        'reference_title',
        'sort_order',
    ];

    public function policyBuilder()
    {
        return $this->belongsTo(PolicyBuilder::class, 'policy_id');
    }

    public function sections()
    {
        return $this->hasMany(ReferenceSection::class, 'reference_id')
            ->orderBy('sort_order');
    }
}
