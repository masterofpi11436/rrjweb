<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleTestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'type',
        'question',
        'sort_order',
    ];

    public function test()
    {
        return $this->belongsTo(
            TrainingBookPartModuleTest::class,
            'test_id'
        );
    }

    public function options()
    {
        return $this->hasMany(
            TrainingBookPartModuleTestQuestionOption::class,
            'question_id'
        )->orderBy('sort_order');
    }
}
