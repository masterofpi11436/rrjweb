<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleForm extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_forms';

    public function module()
    {
        return $this->belongsTo(TrainingBookPartModule::class);
    }
}
