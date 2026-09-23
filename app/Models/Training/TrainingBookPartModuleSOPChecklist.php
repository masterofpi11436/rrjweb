<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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
