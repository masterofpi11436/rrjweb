<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleParagraphList extends Model
{
    protected $table = 'training_book_part_module_paragraph_lists';

    protected $fillable = [
        'paragraph_content_id',
        'type',
        'sort_order',
    ];

    public function paragraph(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleParagraphContent::class,
            'paragraph_content_id'
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleParagraphListItem::class,
            'paragraph_list_id'
        )->orderBy('sort_order');
    }
}
