<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleSOPChecklistPolicy extends Model
{

    protected $table = 'training_book_part_module_sop_checklist_policies';

    protected $fillable = [
        'sop_checklist_id',
        'category',
        'policy_number',
        'title',
        'sort_order',
    ];

    public function checklist()
    {
        return $this->belongsTo(
            TrainingBookPartModuleSOPChecklist::class,
            'sop_checklist_id'
        );
    }
}
