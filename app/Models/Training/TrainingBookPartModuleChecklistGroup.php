<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleChecklistGroup extends Model
{
    protected $table =
        'training_book_part_module_checklist_groups';

    protected $fillable = [
        'checklist_id',
        'title',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleChecklist::class,
            'checklist_id'
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleChecklistItem::class,
            'group_id'
        )->orderBy('sort_order');
    }
}