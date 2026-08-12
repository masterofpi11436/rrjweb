<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleSOPChecklist extends Model
{

    protected $table = 'training_book_part_module_sop_checklists';

    protected $fillable = [
        'title',
        'description',
    ];

    public function policies()
    {
        return $this->hasMany(
            TrainingBookPartModuleSOPChecklistPolicy::class,
            'sop_checklist_id'
        );
    }
}
