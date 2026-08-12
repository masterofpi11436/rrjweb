<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleTestQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option',
        'is_correct',
        'sort_order',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function question()
    {
        return $this->belongsTo(
            TrainingBookPartModuleTestQuestion::class,
            'question_id'
        );
    }
}
