<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingBookPartModuleSOPChecklistPolicy extends Model
{
    protected $table = 'training_book_part_module_sop_checklist_policies';

    protected $fillable = [
        'group_id',
        'policy_number',
        'title',
        'sort_order',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleSOPChecklistGroup::class,
            'group_id'
        );
    }
}
