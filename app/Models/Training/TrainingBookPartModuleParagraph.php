<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleParagraph extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_paragraphs';

    public function module()
    {
        return $this->belongsTo(TrainingBookPartModule::class);
    }

    public function bullets()
    {
        return $this->hasMany(TrainingBookPartModuleParagraphBullet::class, 'module_id');
    }
}
