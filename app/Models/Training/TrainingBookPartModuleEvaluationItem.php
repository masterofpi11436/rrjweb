<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingBookPartModuleEvaluationItem extends Model
{
    protected $table =
        'training_book_part_module_evaluation_items';

    protected $fillable = [
        'evaluation_id',
        'item',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleEvaluation::class,
            'evaluation_id'
        );
    }
}
