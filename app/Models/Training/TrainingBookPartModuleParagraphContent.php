<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleParagraphContent extends Model
{
    protected $table = 'training_book_part_module_paragraph_contents';

    protected $fillable = [
        'paragraph_module_id',
        'heading',
        'content',
        'sort_order',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleParagraph::class,
            'paragraph_module_id'
        );
    }

    public function lists(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleParagraphList::class,
            'paragraph_content_id'
        )->orderBy('sort_order');
    }
}
