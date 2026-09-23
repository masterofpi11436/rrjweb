<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TrainingBookPartModuleEvaluation extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_evaluations';

    protected $fillable = [
        'title',
        'description',
    ];

    public function fields()
    {
        return $this->hasMany(
            TrainingBookPartModuleEvaluationField::class,
            'evaluation_id'
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
