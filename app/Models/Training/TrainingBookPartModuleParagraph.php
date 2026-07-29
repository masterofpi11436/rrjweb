<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleParagraph extends Model
{
    protected $table = 'training_book_part_module_paragraphs';

    protected $fillable = [
        'title',
        'description',
    ];

    public function paragraphs(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleParagraphContent::class,
            'paragraph_module_id'
        )->orderBy('sort_order');
    }
}
