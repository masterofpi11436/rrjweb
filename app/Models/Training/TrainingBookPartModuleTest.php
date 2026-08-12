<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'passing_score',
        'sort_order',
    ];

    public function questions()
    {
        return $this->hasMany(
            TrainingBookPartModuleTestQuestion::class,
            'test_id'
        )->orderBy('sort_order');
    }
}
