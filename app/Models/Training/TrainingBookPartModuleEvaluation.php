<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleEvaluation extends Model
{
    protected $table =
        'training_book_part_module_evaluations';

    protected $fillable = [
        'title',
        'description',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleEvaluationItem::class,
            'checklist_id'
        );
    }
}
