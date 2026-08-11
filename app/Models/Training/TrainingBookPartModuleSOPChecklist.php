<?php

namespace App\Models\Training;

use App\Models\Training\TrainingBookPartModuleSOPChecklistItem;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleSOPChecklist extends Model
{
    protected $table = 'training_book_part_module_sop_checklists';

    protected $fillable = [
        'title',
        'description',
    ];

    public function items()
    {
        return $this->hasMany(
            TrainingBookPartModuleSOPChecklistItem::class,
            'sop_checklist_id'
        );
    }
}
