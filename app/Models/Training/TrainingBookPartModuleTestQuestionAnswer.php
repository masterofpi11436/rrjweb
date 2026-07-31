<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleTestQuestionAnswer extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_test_question_answers';

    protected $fillable = [
        'question_id',
        'answer',
        'case_sensitive',
    ];

    public function question()
    {
        return $this->belongsTo(
            TrainingBookPartModuleTestQuestion::class,
            'question_id'
        );
    }
}
