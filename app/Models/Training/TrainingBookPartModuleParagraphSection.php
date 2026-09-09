<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleParagraphSection extends Model
{
    protected $table = 'training_book_part_module_paragraph_sections';

    protected $fillable = [
        'paragraph_module_id',
        'heading',
        'sort_order',
    ];

    public function paragraphModule(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleParagraph::class,
            'paragraph_module_id'
        );
    }

    public function paragraphs(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleParagraphContent::class,
            'section_id'
        )->orderBy('sort_order');
    }
}
