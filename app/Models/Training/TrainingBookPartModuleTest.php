<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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

    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            TrainingModuleCategory::class,
            'module',
            'training_module_category_assignments',
            'module_id',
            'category_id'
        );
    }
}
