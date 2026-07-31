<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleTestQuestionOption extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_test_question_options';

    protected $fillable = [
        'question_id',
        'option',
        'is_correct',
        'sort_order',
    ];

    public function question()
    {
        return $this->belongsTo(
            TrainingBookPartModuleTestQuestion::class,
            'question_id'
        );
    }
}
