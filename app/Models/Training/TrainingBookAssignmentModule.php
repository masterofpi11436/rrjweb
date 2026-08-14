<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TrainingBookAssignmentModule extends Model
{
    use HasFactory;

    protected $table = 'training_book_assignment_modules';

    protected $fillable = [
        'assignment_id',
        'book_part_module_id',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function assignment()
    {
        return $this->belongsTo(
            TrainingBookAssignment::class,
            'assignment_id'
        );
    }

    public function bookPartModule()
    {
        return $this->belongsTo(
            TrainingBookPartModule::class,
            'book_part_module_id'
        );
    }

    public function items()
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
}