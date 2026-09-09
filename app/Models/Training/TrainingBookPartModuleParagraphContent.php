<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleParagraphContent extends Model
{
    protected $table = 'training_book_part_module_paragraph_contents';

    protected $fillable = [
        'section_id',
        'content',
        'sort_order',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleParagraphSection::class,
            'section_id'
        );
    }

    public function lists(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleParagraphList::class,
            'paragraph_id'
        )->orderBy('sort_order');
    }
}
