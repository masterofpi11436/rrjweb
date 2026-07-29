<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingBookPartModuleParagraphListItem extends Model
{
    protected $table = 'training_book_part_module_paragraph_list_items';

    protected $fillable = [
        'paragraph_list_id',
        'content',
        'sort_order',
    ];

    public function list(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleParagraphList::class,
            'paragraph_list_id'
        );
    }
}
