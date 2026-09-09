<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleSOPChecklist extends Model
{
    protected $table = 'training_book_part_module_sop_checklists';

    protected $fillable = [
        'title',
        'description',
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleSOPChecklistGroup::class,
            'sop_checklist_id'
        )->orderBy('sort_order');
    }
}
