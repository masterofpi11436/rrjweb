<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TrainingBookPartModule extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_modules';

    protected $fillable = [
        'book_part_id',
        'module_type',
        'module_id',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function part(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPart::class,
            'book_part_id'
        );
    }

    public function bookPart(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPart::class,
            'book_part_id'
        );
    }

    public function module(): MorphTo
    {
        return $this->morphTo();
    }

    public function signoffRequirements(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleSignoffRequirement::class,
            'book_part_module_id'
        )->orderBy('sort_order');
    }

    public function assignmentModules(): HasMany
    {
        return $this->hasMany(
            TrainingBookAssignmentModule::class,
            'book_part_module_id'
        );
    }
}
