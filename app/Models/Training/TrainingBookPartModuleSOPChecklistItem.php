<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleSOPChecklistItem extends Model
{
    protected $table = 'training_book_part_module_sop_checklist_items';

    protected $fillable = [
        'sop_checklist_id',
        'item',
        'description',
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
