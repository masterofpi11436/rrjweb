<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingBookPartModuleChecklistItem extends Model
{
    protected $table =
        'training_book_part_module_checklist_items';

    protected $fillable = [
        'group_id',
        'item',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleChecklistGroup::class,
            'group_id'
        );
    }
}