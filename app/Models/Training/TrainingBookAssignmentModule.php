<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TrainingBookAssignmentModule extends Model
{
    use HasFactory;

    protected $table = 'training_book_assignment_modules';

    protected $fillable = [
        'assignment_id',
        'book_part_module_id',
        'status',
        'viewed_at',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookAssignment::class,
            'assignment_id'
        );
    }

    public function bookPartModule(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModule::class,
            'book_part_module_id'
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(
            TrainingBookAssignmentModuleItem::class,
            'assignment_module_id'
        );
    }

    public function signoffs(): MorphMany
    {
        return $this->morphMany(
            TrainingBookAssignmentSignoff::class,
            'signable'
        );
    }

    public function evaluation(): HasOne
    {
        return $this->hasOne(
            TrainingBookAssignmentEvaluation::class,
            'assignment_module_id'
        );
    }
}
