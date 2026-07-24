<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleMedia extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_medias';

    protected $fillable = ['module_id', 'title', 'move', 'complettion_date', 'sort_order'];

    public function module()
    {
        return $this->belongsTo(TrainingBookPartModule::class);
    }
}
