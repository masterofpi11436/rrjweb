<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyBuilder extends Model
{
    use HasFactory;

    protected $table = 'policy_builders';

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'policy_builder_id')
            ->orderBy('sort_order');
    }
}
