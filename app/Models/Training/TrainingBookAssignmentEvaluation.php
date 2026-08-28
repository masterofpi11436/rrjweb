<?php

namespace App\Models\Training;

use App\Models\Login\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookAssignmentEvaluation extends Model
{
    use HasFactory;

    protected $table = 'training_book_assignment_evaluations';

    protected $fillable = [
        'assignment_module_id',
        'strengths',
        'weaknesses',
        'areas_of_improvement',
        'completed_by',
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

    public function completedBy()
    {
        return $this->belongsTo(
            User::class,
            'completed_by'
        );
    }
}