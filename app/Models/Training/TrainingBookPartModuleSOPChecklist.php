<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleSOPChecklist extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_sop_checklists';

    protected $fillable = ['module_id', 'number', 'title', 'link', 'completion_date', 'sort_order'];

    public function module()
    {
        return $this->belongsTo(TrainingBookPartModule::class);
    }
}
