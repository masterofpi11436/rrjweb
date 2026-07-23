<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleParagraphBullet extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_paragraph_bullets';

    public function paragraph()
    {
        return $this->belongsTo(TrainingBookPartModuleParagraph::class);
    }
}
