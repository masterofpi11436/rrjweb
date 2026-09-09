<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingBookPartModuleEvaluationField extends Model
{
    protected $table = 'training_book_part_module_evaluation_fields';

    protected $fillable = [
        'evaluation_id',
        'label',
        'type',
        'required',
        'sort_order',
    ];

    protected $casts = [
        'required' => 'boolean',
    ];

    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleEvaluation::class,
            'evaluation_id'
        );
    }
}
