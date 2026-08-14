<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TrainingBookAssignmentModuleItem extends Model
{
    use HasFactory;

    protected $table = 'training_book_assignment_module_items';

    protected $fillable = [
        'assignment_module_id',
        'module_item_id',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function assignmentModule()
    {
        return $this->belongsTo(
            TrainingBookAssignmentModule::class,
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