<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleSOPChecklistGroup extends Model
{
    protected $table = 'training_book_part_module_sop_checklist_groups';

    protected $fillable = [
        'sop_checklist_id',
        'title',
        'section_number',
        'description',
        'sort_order',
    ];

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleSOPChecklist::class,
            'sop_checklist_id'
        );
    }

    public function policies(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleSOPChecklistPolicy::class,
            'group_id'
        )->orderBy('sort_order');
    }
}
