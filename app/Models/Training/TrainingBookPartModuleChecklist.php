<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleChecklist extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_checklists';

    public function module()
    {
        return $this->belongsTo(TrainingBookPartModule::class);
    }
}
